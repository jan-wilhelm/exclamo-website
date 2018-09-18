<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;

use App\Http\Resources\FullDataUserResource;

class DashboardController extends Controller
{

    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService) {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function dashboard(Request $request)
    {
    	if (Auth::user()->hasRole('schueler')) {
    		return $this->studentDashboardView($request);
    	} elseif (Auth::user()->hasRole('lehrer')) {
    		return $this->teacherDashboardView($request);
    	} elseif (Auth::user()->hasRole('schulleiter')) {
    		return $this->principleDashboardView($request);
    	}

    	return "Error";
    }

    public function studentDashboardView(Request $request)
    {
    	return view("schueler.dashboard");
    }

    public function teacherDashboardView(Request $request)
    {
    	return view("mentors.dashboard");
    }

    public function principleDashboardView(Request $request)
    {
        $loginStatistics = $this->userService
            ->getLoginStatisticsFromSchool(auth()->user()->school);
        return view("schulleiter.dashboard", compact("loginStatistics"));
    }
}
