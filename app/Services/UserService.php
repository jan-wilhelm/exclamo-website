<?php

namespace App\Services;

use App\User;
use App\School;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

	public function getUsersForTable(School $school)
	{
		return $school->users()->studentOrTeacher()->get();
	}

	public function getLoginStatisticsFromSchool(School $school)
	{
		$data = $school->logins()->select('login_activities.created_at')
		    ->get()
		    ->groupBy(function($date) {
		        return Carbon::parse($date->created_at)->startOfDay()->timestamp; // grouping by months
		    })->map(function ($date) {
		    	return $date->count();
		    });

		$dataToReturn = [];

		foreach ($data as $date => $dataCount) {
			$dataToReturn[] = [$date * 1000, $dataCount];
		}

		return $dataToReturn;
	}

}