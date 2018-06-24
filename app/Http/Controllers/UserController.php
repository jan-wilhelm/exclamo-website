<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\School;

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
        $firstName = $request->query('search-vorname', '');
        $lastName = $request->query('search-nachname', '');
        \Session::flash('usersPerPage', $elementsPerPage);
        \Session::flash('firstName', $firstName);
        \Session::flash('lastName', $lastName);

        $school = Auth::user()->school;
        $schoolCounts = $school->withCount(['students', 'teachers', 'admins'])->get()->first();
        $users = $this->getFilteredStudents($school, $firstName, $lastName)->withCount('reportedCases')->simplePaginate($elementsPerPage);

        $oldInput = \Illuminate\Support\Facades\Input::except('page');

        return view("schulleiter.users")->with([
            "numberOfUsers" => $schoolCounts->students_count,
            "numberOfTeachers" => $schoolCounts->teachers_count,
            "numberOfPrinciples" => $schoolCounts->admins_count,
            "users" => $users,
            "oldInput" => $oldInput
        ]);
    }

    private function getFilteredStudents(School $school, $firstName, $lastName) {
        return $school->students()
            ->where('first_name', 'like', '%' . $firstName ."%")
            ->where('last_name', 'like', '%' . $lastName ."%");
            // TODO: Add filter function for class parameter ->where('class', $class);
    }

    public function show(Request $request, User $user)
    {
        return view("schulleiter.user")->with([
            "user" => $user
        ]);
    }
}
