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
     * Show the users page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Set the number of elements shown per page to a minimum of 1 and a default of 10
        $elementsPerPage = max(1, $request->query('entries', 10));
        $firstName = $request->query('search-vorname', '');
        $lastName = $request->query('search-nachname', '');

        // Pass the data to the view
        \Session::flash('usersPerPage', $elementsPerPage);
        \Session::flash('firstName', $firstName);
        \Session::flash('lastName', $lastName);

        $school = Auth::user()->school;

        // Get the counts of the user types of the school
        $schoolCounts = $school->withCount(['students', 'teachers', 'admins'])->find($school)->first();

        // Get the students and paginate them
        $users = $this->getFilteredStudents($school, $firstName, $lastName)->withCount('reportedCases')->simplePaginate($elementsPerPage);

        // The old input query to pass on to the view
        $oldInput = \Illuminate\Support\Facades\Input::except('page');

        return view("schulleiter.users")->with([
            "numberOfUsers" => $schoolCounts->students_count,
            "numberOfTeachers" => $schoolCounts->teachers_count,
            "numberOfPrinciples" => $schoolCounts->admins_count,
            "users" => $users,
            "oldInput" => $oldInput
        ]);
    }

    /**
     * Filter all of the school's students by their first an last name
     * @param  School $school    The school
     * @param  string $firstName Parts of the first name to search for
     * @param  string $lastName  Parts of the last name to search for
     * @return QueryBuilder      The query builder which can return the filtered students. You can also apply other query operations to this return type
     */
    private function getFilteredStudents(School $school, $firstName, $lastName)
    {
        return $school->students()
            ->where('first_name', 'like', '%' . $firstName ."%")
            ->where('last_name', 'like', '%' . $lastName ."%");
            // TODO: Add filter function for class parameter ->where('class', $class);
    }

    /**
     * Show detailed information about a specific user
     * @param  Request $request The HTTP request
     * @param  User    $user    The user whose information should be displayed
     * @return View           The rendered view
     */
    public function show(Request $request, User $user)
    {
        return view("schulleiter.user")->with([
            "user" => $user
        ]);
    }
}
