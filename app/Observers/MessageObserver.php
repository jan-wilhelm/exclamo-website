<?php

namespace App\Observers;

use App\Notifications\MessageSent;
use App\Message;
use Notification;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $case = $message->reportedCase;
        $users = $case->mentors->push($case->victim);

        $users = $users->filter(function ($element) use ($message) {
            return $element->id != $message->sender->id;
        });

        Notification::send($users, new MessageSent($message));
    }

}
