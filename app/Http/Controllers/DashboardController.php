<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware(['auth', 'role:schueler|lehrer']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if (\Auth::user()->hasRole('schueler')) {
        	return $this->studentIndex($request);
    	} elseif (\Auth::user()->hasRole('lehrer')) {
        	return $this->teacherIndex($request);
    	}
    }

    /**
     * Render the details of the user dashboard page
     * @param  Request $request The HTTP Request
     * @return View           The rendered view
     */
    private function studentIndex(Request $request)
    {    	
    	$user = \Auth::user();

    	// Get the Reported Cases along with their assigned mentors which can
    	// then be display in the view.
    	// This is a lot more performent than fetching each case's mentors,
    	// since larger SQL queries are generally faster than a lot of smaller
    	// queries
    	$cases = $user->reportedCases()->select('id')->with('mentors')->get();

    	$numberOfCases = $cases->count();
    	$numberOfResolvedCases = $cases->reject(function($value, $key) {
    		return $value->solved; // Get only the cases which are not yet resolved
    	})->count();

    	$messages = $user->messages->count();

		return view("schueler.index")->with([
			'numberOfCases' => $numberOfCases,
			'numberOfResolvedCases' => $numberOfResolvedCases,
			'numberOfMessages' => $messages
		]);
    }

    private function teacherIndex(Request $request)
    {
		return view("lehrer.index");
    }

}
