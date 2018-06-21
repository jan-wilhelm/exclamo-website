<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware(['auth', 'role:schulleiter']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $elementsPerPage = max(1, $request->query('entries', 10));

        $school = Auth::user()->school;

        $schoolCounts = $school->withCount(['students', 'teachers', 'admins'])->get()->first();

        $users = $school->students()->withCount('reportedCases')->simplePaginate($elementsPerPage);

        $oldInput = \Illuminate\Support\Facades\Input::except('page');

        return view("schulleiter.users")->with([
            "numberOfUsers" => $schoolCounts->students_count,
            "numberOfTeachers" => $schoolCounts->teachers_count,
            "numberOfPrinciples" => $schoolCounts->admins_count,
            "users" => $users,
            "oldInput" => $oldInput,
            "elementsPerPage" => $elementsPerPage
        ]);
    }

    public function show(Request $request, User $user)
    {
        return view("schulleiter.user")->with([
            "user" => $user
        ]);
    }
}
