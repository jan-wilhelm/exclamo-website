<?php

namespace App\Actions;

use App\Message;

class CreateMessageAction
{

	public function execute(String $body, $reportedCaseId, $userId)
	{
        $message = Message::create([
            'body' => $body,
            'reported_case_id' => $reportedCaseId,
            'user_id' => $userId
        ]);

        return $message;
	}

}