<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Http\Requests\MessageCreateRequest;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Only authenticated user may send messages
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function store(MessageCreateRequest $request)
	{
		$validated = $request->validated();
		$message = Message::create([
			"body"=> $validated["message"],
			"user_id"=> auth()->user()->id,
			"reported_case_id"=> $validated["case"]
		]);

		return redirect()->back();
	}

}
