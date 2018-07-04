<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
	
    use HandlesAuthorization;

    public function create(User $user)
    {
    	return $user->mentoring || $user->hasRole("schueler");
    }

    public function view(User $user, Message $message)
    {
        foreach ($user->reportedCases()->with('messages')->get() as $reportedCase) {
        	if ($reportedCase->messages->contains($message)) {
        		return true;
        	}
        }

     	foreach ($user->mentorCases()->with('messages')->get() as $reportedCase) {
        	if ($reportedCase->messages->contains($message)) {
        		return true;
        	}
        }
        return false;
    }

    public function update(User $user, Message $message)
    {
    	return $user->messages->contains($message);
    }

    public function delete(User $user, Message $message)
    {
    	return $user->messages->contains($message);
    }

}
