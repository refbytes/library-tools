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

    public function view(User $user, Subscription $subscription): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('subscriptions:create') || $user->tokenCan('subscriptions:create');
    }

    public function update(User $user, Subscription $subscription): bool
    {
        return $user->can('subscriptions:update') || $user->tokenCan('subscriptions:update');
    }

    public function delete(User $user, Subscription $subscription): bool
    {
        return $user->can('subscriptions:delete') || $user->tokenCan('subscriptions:delete');
    }

    public function restore(User $user, Subscription $subscription): bool
    {
        return $user->can('subscriptions:update') || $user->tokenCan('subscriptions:update');
    }

    public function forceDelete(User $user, Subscription $subscription): bool
    {
        return $user->can('subscriptions:delete') || $user->tokenCan('subscriptions:delete');
    }
}
