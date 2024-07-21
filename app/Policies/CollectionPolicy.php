<?php

namespace App\Policies;

use App\Models\Subscriptions\Collection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Collection $collection): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Collection $collection): bool {}

    public function delete(User $user, Collection $collection): bool {}

    public function restore(User $user, Collection $collection): bool {}

    public function forceDelete(User $user, Collection $collection): bool {}
}
