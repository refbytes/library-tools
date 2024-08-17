<?php

namespace App\Policies;

use App\Models\Subscriptions\Vendor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Vendor $vendor): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->can('subscriptions:create') || $user->tokenCan('subscriptions:create');
    }

    public function update(User $user, Vendor $vendor): bool
    {
        return $user->can('subscriptions:update') || $user->tokenCan('subscriptions:update');
    }

    public function delete(User $user, Vendor $vendor): bool
    {
        return $user->can('subscriptions:delete') || $user->tokenCan('subscriptions:delete');
    }

    public function restore(User $user, Vendor $vendor): bool
    {
        return $user->can('subscriptions:update') || $user->tokenCan('subscriptions:update');
    }

    public function forceDelete(User $user, Vendor $vendor): bool
    {
        return $user->can('subscriptions:delete') || $user->tokenCan('subscriptions:delete');
    }
}
