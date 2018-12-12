<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignupSchoolRequest;

use App\Actions\SignupSchoolAction;

use Redirect;

class SchoolSignupController extends Controller
{

	public function handle(SignupSchoolRequest $request, SignupSchoolAction $action)
	{
		$validated = $request->validated();
		$action->execute($validated["school"], $validated["email"], $validated["contact_person"]);

		return back()->withInput()
                    ->withErrors($request->errors);
	}

}
