<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $authUser)
    {

    }

    public function view(User $authUser, User $user)
    {

    }

    public function update(User $authUser, User $user)
    {
        if (!$user) {
            return false;
        }

        if (!$authUser->hasRole('schulleiter')) {
            return false;
        }

        if ($authUser->school->id != $user->school->id) {
            return false;
        }

        if (!$authUser->school->studentsOrTeachers->contains($user)) {
            return false;
        }

        return true;
    }

    public function delete(User $authUser, User $user)
    {
        return $this->update($authUser, $user);
    }
}
