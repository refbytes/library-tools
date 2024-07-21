<?php

namespace App\Policies;

use App\Models\Subscriptions\Provider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProviderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Provider $provider): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Provider $provider): bool {}

    public function delete(User $user, Provider $provider): bool {}

    public function restore(User $user, Provider $provider): bool {}

    public function forceDelete(User $user, Provider $provider): bool {}
}
