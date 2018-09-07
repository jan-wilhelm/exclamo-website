<?php

namespace App\Services;

use App\Message;
use App\User;

class MessageService
{

	public function getInJSONFormat($messages, $anonymous)
	{
		return $messages->map(function($message) use($anonymous) {
            $messageJson = array();

            $messageJson["anonymous"] = $anonymous;
            $messageJson["id"] = $message->id;

            $messageJson["body"] = $message->body;
            $messageJson["date"] = $message->updated_at->format("d.m.Y G:i");
            $messageJson["sentByUser"] = ($message->sender->id == auth()->id());

            if (!$anonymous) {
                $messageJson["user"] = $message->sender->only(['id', 'first_name', 'last_name']);
            }

            return $messageJson;
        });
	}

}