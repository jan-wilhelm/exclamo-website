<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
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
    	return "teacherDashboardView not yet implemented";
    }

    public function principleDashboardView(Request $request)
    {
    	return "principleDashboardView not yet implemented";
    }
}
