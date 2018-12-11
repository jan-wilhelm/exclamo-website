<?php

namespace App\Actions;

use App\Message;
use App\Events\MessageSent;

class BroadcastMessageAction
{

	public function execute(Message $message)
	{
        return broadcast(new MessageSent($message));
	}

}