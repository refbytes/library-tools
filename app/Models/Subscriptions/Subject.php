<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
}
