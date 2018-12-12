<?php

namespace App\Actions;

use App\SchoolSignup;
use App\User;
use App\Notifications\SchoolSignupNotification;

class SignupSchoolAction
{

	public function execute(String $school, String $email, String $contactPerson)
	{
        $signup = SchoolSignup::create([
            'email' => $email,
            'school' => $school,
            'contact_person' => $contactPerson
        ]);

        User::first()->notify(new SchoolSignupNotification($signup));
        session(['school_sign_up'=> 'true']);

		return $signup;
	}

}