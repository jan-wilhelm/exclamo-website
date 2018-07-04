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

    public function studentView(Request $request, User $user)
    {
        return $this->casesView($user);
    }

    public function mentorView(Request $request, User $user)
    {
        return $this->casesView($user, $this->reportedCases->whereMentoring($user));
    }

    public function casesView(User $user, $cases)
    {
        // Get the Reported Cases along with their assigned mentors which can
        // then be display in the view.
        // This is a lot more performent than fetching each case's mentors,
        // since larger SQL queries are generally faster than a lot of smaller
        // queries
        $cases = $this->reportedCases
            ->getWithData($user, $cases)
            ->orderBy('updated_at', 'desc')
            ->get();

        //dd($cases);

        $resolvedCases = $this->reportedCases->resolved($cases);
        $unresolvedCases = $cases->diff($resolvedCases);

        $statistics = $this->getStatisticsForView($user, $cases, $resolvedCases);

        // render the view and pass all the needed variables
        return view("mentor.cases")->with(
            array_merge(
                $statistics,
                [
                    'cases' => $unresolvedCases->concat($resolvedCases)
                ]
            )
        );
    }

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

        $messages = $case->messages()->with("sender")->orderBy('updated_at', 'asc')->get()->map(function($message) {
                $messageJson = array();
                $messageJson["body"] = $message->body;
                $messageJson["date"] = $message->updated_at->format("d.m.Y G:i");
                $messageJson["sentByUser"] = ($message->sender->id == auth()->id());
                $messageJson["user"] = $message->sender->only(['id', 'first_name', 'last_name']);
                return $messageJson;
        });

        return view("case")->with([
            'case' => $case,
            'messages'=> $messages
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
