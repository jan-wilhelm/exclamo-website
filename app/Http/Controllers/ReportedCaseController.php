<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportedCase;
use App\Http\Requests\ReportCaseRequest;
use App\User;
use App\Location;
use App\Message;
use App\Services\ReportedCaseService;
use App\Repositories\UserRepository;
use App\Repositories\ReportedCaseRepository;
use App\Http\Resources\ReportedCaseResource;

class ReportedCaseController extends Controller
{

    protected $reportedCases;
    protected $caseService;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * Only authenticated students may create new cases
     * @return void
     */
    public function __construct(ReportedCaseRepository $reportedCases, ReportedCaseService $caseService, UserRepository $users)
    {
        $this->middleware('auth');
        $this->reportedCases = $reportedCases;
        $this->caseService = $caseService;
        $this->users = $users;
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
        return view("mentors/cases", compact('cases', 'statistics'));
    }

    public function getMessagesForView(ReportedCase $case)
    {
        $anonymous = $case->anonymous;
        return $case->messages()->with("sender")->orderBy('updated_at', 'asc')->get()->map(function($message) use($anonymous) {
            $messageJson = array();

            $messageJson["anonymous"] = $anonymous;

            $messageJson["body"] = $message->body;
            $messageJson["date"] = $message->updated_at->format("d.m.Y G:i");
            $messageJson["sentByUser"] = ($message->sender->id == auth()->id());

            if (!$anonymous) {
                $messageJson["user"] = $message->sender->only(['id', 'first_name', 'last_name']);
            }

            return $messageJson;
        });
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
        $messages = $this->getMessagesForView($case);

        if (auth()->user()->hasRole("schueler")) {
            return $this->studentDetailView($request, $case, $messages);
        } else {
            return $this->mentorDetailView($request, $case, $messages);
        }
    }

    public function studentDetailView(Request $request, ReportedCase $case, $messages)
    {
        // Categories
        $categories = config('exclamo.categories');
        
        // Mentors
        $allMentors = auth()->user()->school->mentors()->mentoring()->get();
        $possibleMentors = $allMentors->map(function($mentor, $index) {
            return [
                'id'=> $mentor->id,
                'name'=> $mentor->full_name
            ];
        });

        // Locations
        $locations = auth()->user()->school->locations->map(function ($location, $index) {
            return [
                'id'=> $location->id,
                'name'=> $location->title
            ];
        });

        // Client Data
        $clientData = new ReportedCaseResource($case);

        return view("schueler.case")->with([
            'case' => $case,
            'messages'=> $messages,
            'categories'=> $categories,
            'possibleMentors'=> $possibleMentors,
            'clientData'=> $clientData,
            'locations'=> $locations
        ]);
    }

    public function mentorDetailView(Request $request, ReportedCase $case, $messages)
    {
        return view("mentors.case")->with([
            'case'=> $case,
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

}
