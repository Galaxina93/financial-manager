<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Die Attribute, die nicht massenhaft zugewiesen werden dürfen.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Definiert die Beziehung zum User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definiert die Beziehung zu SpecialIssues.
     * Achtung: Dies basiert auf dem Namen, nicht auf einer ID.
     */
    public function specialIssues(): HasMany
    {
        return $this->hasMany(SpecialIssue::class, 'why', 'name');
    }
}
