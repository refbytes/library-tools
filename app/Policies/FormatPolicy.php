<?php

namespace App\Policies;

use App\Models\Subscriptions\Format;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormatPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, Format $format): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Format $format): bool {}

    public function delete(User $user, Format $format): bool {}

    public function restore(User $user, Format $format): bool {}

    public function forceDelete(User $user, Format $format): bool {}
}
