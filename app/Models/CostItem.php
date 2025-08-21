<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CostItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Die Attribute, die in Datums-Objekte umgewandelt werden sollen.
     *
     * @var array
     */
    protected $casts = [
        'interval_start' => 'date',
        'interval_end' => 'date',
    ];

    /**
     * Definiert die Beziehung zum User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definiert die Beziehung zur Gruppe.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Definiert die Beziehung zum Vertrag.
     */
    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }
}
