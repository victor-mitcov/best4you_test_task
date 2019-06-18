<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = ['name', 'parent_id'];

    /**
     * Relation to parent branch
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'parent_id');
    }

    /**
     * Relation to children branches
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Branch::class, 'parent_id');
    }
}
