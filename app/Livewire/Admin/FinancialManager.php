<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Contract;
use App\Models\CostItem;
use App\Models\Group;
use App\Models\SpecialIssue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class FinancialManager extends Component
{
    use WithPagination;

    // #region UI State
    public bool $showSpecialIssuesTable = false;
    public bool $showCategoryManager = false;
    public bool $showGroupManager = false;
    public bool $showYearlySummary = false;
    public bool $showChart = false;

    public array $openCostItems = [];
    public array $openGroups = [];

    public ?int $confirmingSpecialIssueDeletion = null;
    public ?int $confirmingCategoryDeletion = null;
    public ?int $confirmingGroupDeletion = null;
    public ?int $confirmingCostItemDeletion = null;
    // #endregion

    // #region Form Properties
    public string $what = '';
    public string $where = '';
    public ?float $price = null;
    public string $when = '';
    public string $why = '';
    // #endregion

    // #region Filters
    public string $search = '';
    public int $currentYear;
    // #endregion

    public function mount(): void
    {
        $this->when = now()->format('Y-m-d');
        $this->currentYear = now()->year;

        $firstCategory = Category::where('user_id', auth()->id())->orderBy('position')->first();
        if ($firstCategory) {
            $this->why = $firstCategory->name;
        }
    }

    // #region Computed Properties
    #[Computed]
    public function quickViewSummary()
    {
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
        $currentMonthTransactions = SpecialIssue::where('user_id', auth()->id())->whereBetween('when', [$currentMonthStart, $currentMonthEnd]);
        $balanceQuery = clone $currentMonthTransactions;
        $expenseQuery = clone $currentMonthTransactions;
        $currentMonthBalance = $balanceQuery->sum('price');
        $currentMonthExpenses = $expenseQuery->where('price', '<', 0)->sum('price');
        $totalBalance = SpecialIssue::where('user_id', auth()->id())->sum('price');
        return [
            'monthName' => now()->translatedFormat('F'),
            'currentMonthBalance' => $currentMonthBalance,
            'currentMonthExpenses' => $currentMonthExpenses,
            'totalBalance' => $totalBalance,
        ];
    }

    #[Computed(persist: true, seconds: 3600)]
    public function initialCategories()
    {
        return Category::query()
            ->where('categories.user_id', auth()->id())
            ->select('categories.*', DB::raw('COUNT(special_issues.id) as usage_count'))
            ->leftJoin('special_issues', function($join) {
                $join->on('categories.name', '=', 'special_issues.why')->where('special_issues.user_id', '=', auth()->id());
            })
            ->groupBy('categories.id', 'categories.name', 'categories.user_id', 'categories.position', 'categories.created_at', 'categories.updated_at')
            ->orderByDesc('usage_count')->orderBy('position')->get();
    }

    #[Computed]
    public function categories()
    {
        return Category::where('user_id', auth()->id())->orderBy('position')->get();
    }

    #[Computed]
    public function specialIssues()
    {
        return SpecialIssue::where('user_id', auth()->id())
            ->where(function($query) {
                $search = '%' . $this->search . '%';
                $query->where('what', 'like', $search)->orWhere('where', 'like', $search)->orWhere('price', 'like', $search)->orWhere('why', 'like', $search);
            })
            ->orderBy('when', 'desc')->orderBy('created_at', 'desc')->paginate(10);
    }

    #[Computed]
    public function groups()
    {
        return Group::where('user_id', auth()->id())->with(['costItems.contract'])->get();
    }

    #[Computed]
    public function yearlySummary()
    {
        $specialIssueModel = new SpecialIssue();
        $totalYear = $specialIssueModel->getYear($this->currentYear)->sum();
        $totalMonth = SpecialIssue::where('user_id', auth()->id())->whereYear('when', $this->currentYear)->whereMonth('when', now()->month)->sum('price');
        return [
            'all_yearly_amounts' => $specialIssueModel->getYear($this->currentYear),
            'all_monthly_amounts' => $specialIssueModel->getMonth($this->currentYear),
            'total_current_year' => $totalYear,
            'total_current_month' => $totalMonth,
        ];
    }

    #[Computed]
    public function chartData()
    {
        $data = SpecialIssue::where('user_id', auth()->id())->whereYear('when', $this->currentYear)
            ->select(DB::raw('MONTH(`when`) as month'), DB::raw('SUM(CASE WHEN price > 0 THEN price ELSE 0 END) as income'), DB::raw('SUM(CASE WHEN price < 0 THEN price ELSE 0 END) as expense'))
            ->groupBy('month')->orderBy('month')->get();
        $labels = [];
        $incomeData = array_fill(1, 12, 0);
        $expenseData = array_fill(1, 12, 0);
        foreach ($data as $row) {
            $incomeData[$row->month] = $row->income;
            $expenseData[$row->month] = abs($row->expense);
        }
        for ($m=1; $m<=12; $m++) { $labels[] = Carbon::create()->month($m)->translatedFormat('F'); }
        return [
            'labels' => $labels,
            'datasets' => [
                [ 'label' => 'Einnahmen', 'data' => array_values($incomeData), 'backgroundColor' => 'rgba(75, 192, 192, 0.5)', 'borderColor' => 'rgb(75, 192, 192)', 'tension' => 0.1 ],
                [ 'label' => 'Ausgaben', 'data' => array_values($expenseData), 'backgroundColor' => 'rgba(255, 99, 132, 0.5)', 'borderColor' => 'rgb(255, 99, 132)', 'tension' => 0.1 ],
            ],
        ];
    }
    // #endregion

    // #region Main Actions
    public function submitSpecialIssue(): void
    {
        $validatedData = $this->validate([
            'what' => 'required|string|min:3', 'where' => 'required|string', 'price' => 'required|numeric',
            'when' => 'required|date', 'why' => 'required|string|exists:categories,name,user_id,' . auth()->id(),
        ]);
        SpecialIssue::create(['user_id' => auth()->id()] + $validatedData);
        $this->reset('what', 'where', 'price');
        $this->when = now()->format('Y-m-d');
        $this->dispatch('flash-message', message: 'Ausgabe gespeichert!', type: 'success');
        $this->dispatch('update-chart', data: $this->chartData());
    }

    public function updateSpecialIssue($id, $field, $value)
    {
        $issue = SpecialIssue::findOrFail($id);
        $rules = [
            'what' => 'required|string|min:3', 'where' => 'required|string',
            'price' => 'required|numeric', 'why' => 'required|string|exists:categories,name',
        ];
        Validator::make([$field => $value], [$field => $rules[$field]])->validate();
        $issue->update([$field => $value]);
        $this->dispatch('flash-message', message: 'Eintrag aktualisiert.', type: 'info');
    }

    public function deleteSpecialIssue(SpecialIssue $issue): void
    {
        $issue->delete();
        $this->confirmingSpecialIssueDeletion = null;
        unset($this->specialIssues);
        $this->dispatch('flash-message', message: 'Eintrag gelöscht!', type: 'danger');
        $this->dispatch('update-chart', data: $this->chartData());
    }

    public function createCategory(): void
    {
        Category::create(['user_id' => auth()->id(), 'name' => 'Neue Kategorie', 'position' => (Category::where('user_id', auth()->id())->count() ?? 0) + 1]);
        unset($this->categories);
        $this->dispatch('flash-message', message: 'Kategorie erstellt.', type: 'success');
    }

    public function updateCategoryName($id, $name)
    {
        $category = Category::findOrFail($id);
        Validator::make(['name' => $name], ['name' => 'required|string|min:2'])->validate();
        $category->update(['name' => $name]);
        $this->dispatch('flash-message', message: 'Kategorie aktualisiert.', type: 'info');
    }

    public function deleteCategory(Category $category): void
    {
        if ($category->specialIssues()->count() > 0) {
            $this->dispatch('flash-message', message: 'Kategorie wird noch verwendet.', type: 'warning');
            return;
        }
        $category->delete();
        $this->confirmingCategoryDeletion = null;
        unset($this->categories);
        $this->dispatch('flash-message', message: 'Kategorie gelöscht!', type: 'danger');
    }

    public function createGroup(): void
    {
        Group::create(['user_id' => auth()->id(), 'name' => 'Neue Gruppe']);
        unset($this->groups);
    }

    public function updateGroup($id, $value)
    {
        Validator::make(['name' => $value], ['name' => 'required|string|min:2'])->validate();
        Group::find($id)->update(['name' => $value]);
        $this->dispatch('flash-message', message: 'Gruppe aktualisiert.', type: 'info');
    }

    public function deleteGroup(Group $group): void
    {
        $group->costItems()->each(function ($costItem) {
            $costItem->contract()->delete();
            $costItem->delete();
        });
        $group->delete();
        $this->confirmingGroupDeletion = null;
        unset($this->groups);
        $this->dispatch('flash-message', message: 'Gruppe gelöscht!', type: 'danger');
    }

    public function createCostItem(Group $group): void
    {
        $costItem = $group->costItems()->create([
            'user_id' => auth()->id(), 'name' => 'Neue Kostenstelle', 'amount' => 0,
            'billing_type' => 'monthly', 'interval_start' => now(),
        ]);
        $costItem->contract()->create(['user_id' => auth()->id()]);

        if (!in_array($group->id, $this->openGroups)) {
            $this->openGroups[] = $group->id;
        }

        unset($this->groups);
    }

    public function updateCostItem($id, $field, $value)
    {
        $rules = ['name' => 'required|string|min:2', 'amount' => 'required|numeric'];
        Validator::make([$field => $value], [$field => $rules[$field]])->validate();
        CostItem::find($id)->update([$field => $value]);
        $this->dispatch('flash-message', message: 'Kostenstelle aktualisiert.', type: 'info');
    }

    public function updateCostItemBillingType(CostItem $item, string $type): void
    {
        $item->update(['billing_type' => $type]);
    }

    public function deleteCostItem(CostItem $costItem): void
    {
        $costItem->contract()->delete();
        $costItem->delete();
        $this->confirmingCostItemDeletion = null;
        unset($this->groups);
        $this->dispatch('flash-message', message: 'Kostenstelle gelöscht!', type: 'danger');
    }

    public function updateContract(Contract $contract, string $field, string $value): void
    {
        $contract->update([$field => $value]);
        $this->dispatch('flash-message', message: 'Vertrag aktualisiert.', type: 'info');
    }

    public function toggleCostItemDetails(int $id): void
    {
        $this->openCostItems = in_array($id, $this->openCostItems) ? array_diff($this->openCostItems, [$id]) : [...$this->openCostItems, $id];
    }

    public function toggleGroupDetails(int $id): void
    {
        $this->openGroups = in_array($id, $this->openGroups) ? array_diff($this->openGroups, [$id]) : [...$this->openGroups, $id];
    }
    // #endregion

    // #region UI Helpers
    public function toggleSection(string $section): void
    {
        $this->{$section} = !$this->{$section};
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCurrentYear(): void
    {
        unset($this->yearlySummary);
        $this->dispatch('update-chart', data: $this->chartData());
    }
    // #endregion

    public function render()
    {
        return view('livewire.widgets.financial-manager');
    }
}
