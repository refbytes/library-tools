<?php

namespace App\Policies;

use App\Models\Subscriptions\Proxy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProxyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Proxy $proxy): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Proxy $proxy): bool {}

    public function delete(User $user, Proxy $proxy): bool {}

    public function restore(User $user, Proxy $proxy): bool {}

    public function forceDelete(User $user, Proxy $proxy): bool {}
}
