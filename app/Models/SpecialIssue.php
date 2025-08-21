<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpecialIssue extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Beziehung zur Kategorie
    public function category()
    {
        return $this->belongsTo(Category::class, 'why', 'name');
    }

    /**
     * Ermittelt die monatlichen Summen für jede Kategorie in einem gegebenen Jahr.
     */
    public function getMonth($year)
    {
        return self::select(
            'why',
            DB::raw('MONTH(`when`) as month'), // <-- KORREKTUR
            DB::raw('SUM(price) as total')
        )
            ->whereYear('when', $year)
            ->where('user_id', auth()->id())
            ->groupBy('why', 'month') // 'month' muss hier auch im groupBy sein
            ->get()
            ->groupBy('why');
    }

    /**
     * Ermittelt die jährlichen Summen für jede Kategorie in einem gegebenen Jahr.
     */
    public function getYear($year)
    {
        return self::select('why', DB::raw('SUM(price) as total'))
            ->whereYear('when', $year)
            ->where('user_id', auth()->id())
            ->groupBy('why')
            ->pluck('total', 'why');
    }
}
