<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;

class SchoolController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	//$this->middleware(['auth', 'role:schulleiter']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("schools.index");
    }

    public function showSchool(School $school) {
        return view("schools.school")->with("school", $school);
    }
}
