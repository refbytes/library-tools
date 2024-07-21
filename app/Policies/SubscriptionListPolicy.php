<?php

namespace App\Policies;

use App\Models\Subscriptions\SubscriptionList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionListPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, SubscriptionList $list): bool {}

    public function create(User $user): bool {}

    public function update(User $user, SubscriptionList $list): bool {}

    public function delete(User $user, SubscriptionList $list): bool {}

    public function restore(User $user, SubscriptionList $list): bool {}

    public function forceDelete(User $user, SubscriptionList $list): bool {}
}
