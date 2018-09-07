<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportedCase;
use App\Http\Requests\ReportCaseRequest;
use App\Http\Resources\ReportedCaseResource;

use App\User;
use App\Location;
use App\Message;

use App\Services\ReportedCaseService;
use App\Services\LocationService;
use App\Services\UserService;
use App\Services\MessageService;

use App\Repositories\ReportedCaseRepository;

class ReportedCaseController extends Controller
{

    protected $reportedCases;
    protected $caseService;
    protected $locationService;
    protected $userService;
    protected $messageService;

    /**
     * Create a new controller instance.
     *
     * Only authenticated students may create new cases
     * @return void
     */
    public function __construct(ReportedCaseService $caseService, LocationService $locationService, UserService $userService, MessageService $messageService) {
        $this->middleware('auth');

        $this->reportedCases = $caseService->cases;

        $this->caseService = $caseService;
        $this->locationService = $locationService;
        $this->userService = $userService;
        $this->messageService = $messageService;
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
        $cases = $this->caseService->getOrderedForView($user);
        $statistics = $this->caseService->getStatistics($user, $cases);

        $cases = $cases[0]->concat($cases[1]);
        return view("schueler.cases", compact('cases', 'statistics'));
    }

    /**
     * Show an overview of all of his / her cases to a mentor
     * @param  Request $request The HTTP request
     * @param  User    $user    The mentor
     * @return view           The view
     */
    public function mentorView(Request $request, User $user)
    {
        $cases = $this->caseService->getOrderedForView($user, $this->reportedCases->whereMentoring($user));
        $statistics = $this->caseService->getStatistics($user, $cases);

        $cases = $cases[0]->concat($cases[1]);
        return view("mentors.cases", compact('cases', 'statistics'));
    }

    public function getMessagesForView(ReportedCase $case, $anonymous)
    {
        $messages = $case->messages()->with("sender")->orderBy('updated_at', 'asc')->get();
        return $this->messageService->getInJSONFormat($messages, $anonymous);
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

        if (auth()->user()->hasRole("schueler")) {
            $messages = $this->getMessagesForView($case, false);
            return $this->studentDetailView($request, $case, $messages);
        } else {
            $messages = $this->getMessagesForView($case, $case->anonymous);
            return $this->mentorDetailView($request, $case, $messages);
        }
    }

    public function studentDetailView(Request $request, ReportedCase $case, $messages)
    {
        // Categories
        $categories = config('exclamo.categories');
        
        // Mentors
        $allMentors = auth()->user()->school->mentors()->mentoring()->get();
        $possibleMentors = $this->userService->getInJSONFormat($allMentors);

        $locations = $this->locationService->getLocationDataForUser(auth()->user());
        $clientData = new ReportedCaseResource($case);

        return view("schueler.case", compact('case', 'messages', 'categories', 'possibleMentors', 'clientData', 'locations'));
    }

    public function mentorDetailView(Request $request, ReportedCase $case, $messages)
    {
        return view("mentors.case", compact('case', 'messages'));
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
        $this->authorize('create', ReportedCase::class);
        return view("schueler.report");
    }

}
