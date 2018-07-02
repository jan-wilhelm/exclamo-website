<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Rules\ReportedCaseExistsAndBelongsToUser;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:token-and-cookie');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message'=> 'required|string',
            'case'=> [
                'required',
                new ReportedCaseExistsAndBelongsToUser(Auth::user())
            ]
        ]);

        $message = Message::create([
            'body' => $validated['message'],
            'reported_case_id' => $validated['case'],
            'user_id' => Auth::id()
        ]);

        return $this->show($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
