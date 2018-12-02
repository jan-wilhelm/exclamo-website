<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;

use App\Http\Resources\FullDataUserResource;

use App\User;
use App\School;

class NoteController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService) {
        $this->middleware('role:schueler');
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
    	$content = Auth::user()->notes;
    	return view("schueler.notes")->with([
    		"note" => $content
    	]);
    }

    public function update(Request $request)
    {
    	$validated = $request->validate([
    		'note'=> 'required|string'
    	]);
    	Auth::user()->notes = $validated["note"];
    	Auth::user()->save();

    	return redirect()->action('NoteController@index');
    }
}
