<div x-show="$wire.showYearlySummary" x-collapse>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Jahresübersicht</h3>
            <input type="number" wire:model.live="currentYear" class="w-24 text-center rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-center">
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <div class="text-sm text-gray-600 dark:text-gray-400">Summe {{ \Carbon\Carbon::now()->month($this->currentYear == now()->year ? now()->month : 1)->format('F') }}</div>
                <div class="text-2xl font-bold {{ $this->yearlySummary['total_current_month'] < 0 ? 'text-red-500' : 'text-green-500' }}">
                    {{ number_format($this->yearlySummary['total_current_month'], 2, ',', '.') }} €
                </div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <div class="text-sm text-gray-600 dark:text-gray-400">Summe Jahr {{ $this->currentYear }}</div>
                <div class="text-2xl font-bold {{ $this->yearlySummary['total_current_year'] < 0 ? 'text-red-500' : 'text-green-500' }}">
                    {{ number_format($this->yearlySummary['total_current_year'], 2, ',', '.') }} €
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategorie</th>
                    @for ($i = 1; $i <= 12; $i++)
                        <th class="px-2 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ \Carbon\Carbon::create()->month($i)->shortMonthName }}</th>
                    @endfor
                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider bg-gray-100 dark:bg-gray-600">Total {{ $this->currentYear }}</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @php $monthlyTotals = array_fill(1, 12, 0); @endphp
                @forelse($this->yearlySummary['all_monthly_amounts'] as $category => $months)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap font-semibold text-gray-800 dark:text-gray-200">{{ $category }}</td>
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $monthData = $months->firstWhere('month', $i);
                                $total = $monthData ? $monthData->total : 0;
                                $monthlyTotals[$i] += $total;
                            @endphp
                            <td class="px-2 py-2 text-right text-sm {{ $total < 0 ? 'text-red-500' : 'text-green-500' }}">
                                {{ $total != 0 ? number_format($total, 2, ',', '.') : '-' }}
                            </td>
                        @endfor
                        <td class="px-4 py-2 text-right font-bold bg-gray-100 dark:bg-gray-600 {{ ($this->yearlySummary['all_yearly_amounts'][$category] ?? 0) < 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ number_format($this->yearlySummary['all_yearly_amounts'][$category] ?? 0, 2, ',', '.') }} €
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="14" class="text-center py-10 text-gray-500 dark:text-gray-400">Keine Daten für {{ $this->currentYear }} gefunden.</td></tr>
                @endforelse
                </tbody>
                <tfoot class="bg-gray-100 dark:bg-gray-600 font-bold text-gray-800 dark:text-gray-200">
                <tr>
                    <td class="px-4 py-2 text-left">Total</td>
                    @for ($i = 1; $i <= 12; $i++)
                        <td class="px-2 py-2 text-right text-sm {{ $monthlyTotals[$i] < 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ number_format($monthlyTotals[$i], 2, ',', '.') }}
                        </td>
                    @endfor
                    <td class="px-4 py-2 text-right {{ $this->yearlySummary['total_current_year'] < 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ number_format($this->yearlySummary['total_current_year'], 2, ',', '.') }} €
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
