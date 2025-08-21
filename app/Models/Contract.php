<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Definiert die Beziehung zum User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definiert die Beziehung zur Kostenstelle.
     */
    public function costItem(): BelongsTo
    {
        return $this->belongsTo(CostItem::class);
    }
}
