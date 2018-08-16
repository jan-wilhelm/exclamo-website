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

    public function index() {
        return Auth::user()->messages->map(function ($message, $key) {
            return new MessageResource($message);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Message::class);

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

        // Return the freshly created Message. This can be useful for the client
        // to know the message id etc.
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
        $this->authorize('view', $message);
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
