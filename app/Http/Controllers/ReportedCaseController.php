<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportedCase;
use App\Http\Requests\ReportCaseRequest;
use App\User;
use App\Location;
use App\Message;
use App\Repositories\ReportedCaseRepository;

class ReportedCaseController extends Controller
{

    protected $reportedCases;

    /**
     * Create a new controller instance.
     *
     * Only authenticated students may create new cases
     * @return void
     */
    public function __construct(ReportedCaseRepository $reportedCases)
    {
        $this->middleware('auth');
        $this->reportedCases = $reportedCases;
    }

    /**
     * Render the details of the user cases page
     * @param  Request $request The HTTP Request
     * @return View           The rendered view
     */
    public function index(Request $request)
    {
    	$user = \Auth::user();

        if ($user->hasRole("schueler")) {
            return $this->studentView($request, $user);
        } elseif ($user->mentoring) {
            return $this->mentorView($request, $user);
        } elseif ($user->isMentor()) {
            return $this->inactiveMentorView($request, $user);
        }
    	return "Error";
    }

    /**
     * Show an overview of all of his / her cases to a student
     * @param  Request $request The HTTP request
     * @param  User    $user    The student
     * @return view           The view
     */
    public function studentView(Request $request, User $user)
    {
        $cases = $this
            ->reportedCases->getOrderedForView($user);
        $unresolvedCases = $cases[0];
        $resolvedCases = $cases[1];

        $cases = $unresolvedCases->concat($resolvedCases);

        $statistics = $this->getStatisticsForView($user, $cases, $resolvedCases);

        return view("schueler/cases")->with(
            array_merge(
                $statistics,
                [
                    'cases' => $cases
                ]
            )
        );
    }

    /**
     * Show an overview of all of his / her cases to a mentor
     * @param  Request $request The HTTP request
     * @param  User    $user    The mentor
     * @return view           The view
     */
    public function mentorView(Request $request, User $user)
    {
        $cases = $this->reportedCases
            ->getOrderedForView($user, $this->reportedCases->whereMentoring($user));
        $unresolvedCases = $cases[0];
        $resolvedCases = $cases[1];

        $cases = $unresolvedCases->concat($resolvedCases);

        $statistics = $this->getStatisticsForView($user, $cases, $resolvedCases);

        return view("mentors/cases")->with(
            array_merge(
                $statistics,
                [
                    'cases' => $cases
                ]
            )
        );
    }

    /**
     * Get the case statistics for a specified user
     * @param  User   $user          The user
     * @param  array $cases         The subset of cases of which the data should be included in the stats
     * @param  array $resolvedCases The subset of the $cases argument which are already resolved
     * @return array                An array with the statistics
     */
    public function getStatisticsForView(User $user, $cases, $resolvedCases)
    {
        return [
            'numberOfCases' => $cases->count(),
            'numberOfResolvedCases' => $resolvedCases->count(),
            'numberOfMessages' => $user->messages()->count()
        ];
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
        $this->authorize('view', $case);

        // Transform the collection of messages into a dictionary that
        // can be read by the vue components
        $messages = $case->messages()->with("sender")->orderBy('updated_at', 'asc')->get()->map(function($message) {
                $messageJson = array();
                $messageJson["body"] = $message->body;
                $messageJson["date"] = $message->updated_at->format("d.m.Y G:i");
                $messageJson["sentByUser"] = ($message->sender->id == auth()->id());
                $messageJson["user"] = $message->sender->only(['id', 'first_name', 'last_name']);
                return $messageJson;
        });

        $plainCategories = config('exclamo.categories');

        $categories = collect($plainCategories)->map(function($value, $index) {
            return [
                'id'=> $index,
                'name'=> $value
            ];
        });

        $selectedCategory = array_search($case->category, $plainCategories);

        return view("case")->with([
            'case' => $case,
            'messages'=> $messages,
            'categories'=> $categories,
            'selectedCategory'=> $selectedCategory
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

        // Create a new ReportedCase instance with the given fields
        $case = $this->createReportedCase($validated, auth()->user(), config("exclamo.categories"));
        // Tell the view that a new case has been created
        $request->session()->flash('casecreated', true);

        return \Redirect::route('incidents.show', [$case]);
    }

    /**
     * Creates and stores a new ReportedCase with the given parameters
     *
     * Note that the $user should be authorized to perform this action
     * as this method does not check for that.
     * @param  array    $params     An array of fields for the case
     * @param  User|null $user       The creator of the new case
     * @param  array    $categories An array containing the possible categories of a case
     * @return ReportedCase                The created case
     */
    public function createReportedCase($params, User $user = null, $categories)
    {
        $title = $params['title'];
        $message = $params['message'];
        $mentorIDs = $params['mentors'];
        $category = $params['category'];
        $date = $params['incident_date'];
        $location = Location::find($params['location']);
        $anonymous = isset($params['case-anonymous']) && $params['case-anonymous'];

        $case = ReportedCase::make([
            "title" => $title,
            "category" => $categories[$category],
            "anonymous" => $anonymous,
            "location" => $location
        ]);

        // Set the creator of the case and save it
        $case->victim()->associate($user);
        $case->save();
        // Add the selected mentors to the case
        $case->mentors()->saveMany(User::find($mentorIDs));

        // Create the initial message from the description text
        // and add it to the case
        $initialMessage = Message::make([
            "body"=> $message
        ]);
        $initialMessage->user_id = $user->id;
        $initialMessage->reportedCase()->associate($case);
        $initialMessage->save();

        $case->messages()->save($initialMessage);

        return $case;
    }

}
