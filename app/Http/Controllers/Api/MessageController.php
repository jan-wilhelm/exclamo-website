<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\ReportedCase;
use App\Rules\ReportedCaseExistsAndBelongsToUser;
use App\Events\MessageSent;

use App\Actions\CreateMessageAction;
use App\Actions\BroadcastMessageAction;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {
        return MessageResource::collection(Auth::user()->messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateMessageAction $action)
    {
        $this->authorize('create', Message::class);

        $data = $request->validate([
            'message'=> 'required|string',
            'case'=> [
                'required',
                new ReportedCaseExistsAndBelongsToUser(Auth::user())
            ]
        ]);

        $message = $action->execute($data["message"], $data["case"], Auth::id());
        (new BroadcastMessageAction)->execute($message)->toOthers();

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

    public function messagesForCase(ReportedCase $case) {
        $this->authorize('view', $case);
        return MessageResource::collection($case->messages);
    }
}
