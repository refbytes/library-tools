<?php

namespace App\Policies;

use App\Models\Subscriptions\Authentication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthenticationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Authentication $authentication): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Authentication $authentication): bool {}

    public function delete(User $user, Authentication $authentication): bool {}

    public function restore(User $user, Authentication $authentication): bool {}

    public function forceDelete(User $user, Authentication $authentication): bool {}
}
