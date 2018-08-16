<?php

namespace App\Policies;

use App\User;
use App\ReportedCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportedCasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the reported case.
     *
     * @param  \App\User  $user
     * @param  \App\ReportedCase  $reportedCase
     * @return mixed
     */
    public function view(User $user, ReportedCase $reportedCase)
    {
        return $reportedCase->victim->id == $user->id || $reportedCase->mentors()->where("id", $user->id)->exists();
    }

    /**
     * Determine whether the user can create reported cases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole("schueler");
    }

    /**
     * Determine whether the user can update the reported case.
     *
     * @param  \App\User  $user
     * @param  \App\ReportedCase  $reportedCase
     * @return mixed
     */
    public function update(User $user, ReportedCase $reportedCase)
    {
        // Only the creator of the case may update it
        return $reportedCase->victim->id == $user->id;
    }

    /**
     * Determine whether the user can delete the reported case.
     *
     * @param  \App\User  $user
     * @param  \App\ReportedCase  $reportedCase
     * @return mixed
     */
    public function delete(User $user, ReportedCase $reportedCase)
    {
        return false;
    }
}
