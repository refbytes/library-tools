<?php

namespace App\Policies;

use App\Models\Subscriptions\Subscription;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Subscription $subscription): bool {}

    public function create(User $user): bool
    {
        return $user->can('create') || $user->tokenCan('create');
    }

    public function update(User $user, Subscription $subscription): bool {}

    public function delete(User $user, Subscription $subscription): bool {}

    public function restore(User $user, Subscription $subscription): bool {}

    public function forceDelete(User $user, Subscription $subscription): bool {}
}
