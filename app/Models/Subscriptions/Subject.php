<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'parent_id');
    }
}
