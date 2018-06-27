<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportedCase;
use App\Http\Requests\ReportCaseRequest;

class ReportedCaseController extends Controller
{

    /**
     * Render the details of the user cases page
     * @param  Request $request The HTTP Request
     * @return View           The rendered view
     */
    public function index(Request $request)
    {    	
    	$user = \Auth::user();

    	// Get the Reported Cases along with their assigned mentors which can
    	// then be display in the view.
    	// This is a lot more performent than fetching each case's mentors,
    	// since larger SQL queries are generally faster than a lot of smaller
    	// queries
    	$cases = $user->reportedCases()->with([
    		'mentors',
    		// also get all the messages sorted by their creation date
    		'messages' => function($query) {
    			$query->orderBy('updated_at', 'desc');
    		}
    	])->orderBy('solved', 'asc')->get();

    	$numberOfCases = $cases->count();
    	$numberOfResolvedCases = $cases->reject(function($value, $key) {
    		return $value->solved; // Get only the cases which are not yet resolved
    	})->count();

    	$messages = $user->messages->count();

    	// render the view and pass all the needed variables
		return view("schueler.index")->with([
			'numberOfCases' => $numberOfCases,
			'numberOfResolvedCases' => $numberOfResolvedCases,
			'numberOfMessages' => $messages,
			'cases' => $cases
		]);
    }

    /**
     * Show a specific case to the user
     *
     * This is a complete read function which does not manipulate
     * any data. It is only used to generate the view which shows
     * a specific $case and its available options to the user.
     * @param  Request      $request The HTTP Request
     * @param  ReportedCase $case    The case that should be displayed
     * @return View                The view
     */
    public function showIncident(Request $request, ReportedCase $case)
    {
        return view("schueler.case")->with([
            'case' => $case
        ]);
    }

    /**
     * Simply return the report view.
     *
     * This view contains the form needed to create a
     * ReportCaseRequest on the client side.
     * 
     * @return View          The view
     */
    public function report()
    {
        return view("schueler.report");
    }

    /**
     * Generate the ReportedCase object matching the data given
     * in the $request and store it in the database.
     *
     * This function also handles all authorization and request
     * validation and is therefore safe to use as the web endpoint.
     * @param  ReportCaseRequest $request The request
     * @return Response                     A redirect to the last page of the user
     */
    public function store(ReportCaseRequest $request)
    {
        $validated = $request->validated();
        return redirect()->back();
    }

}
