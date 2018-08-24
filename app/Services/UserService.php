<?php

namespace App\Services;

use App\User;
use App\Repositories\UserRepository;

class UserService
{

	protected $userRepo;

	public function __construct(UserRepository $userRepo)
	{
		$this->userRepo = $userRepo;
	}

	public function getInJSONFormat($users)
	{
		return $users->map(function($mentor, $index) {
            return [
                'id'=> $mentor->id,
                'name'=> $mentor->full_name
            ];
        });
	}

}