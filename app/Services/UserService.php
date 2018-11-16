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

	public function getUsersForTable(School $school)
	{
		return $school->users()->studentOrTeacher()->get();
	}

	public function getLoginStatisticsFromSchool(School $school, $days = 30)
	{
		$startDate = Carbon::now()->subDays($days - 1)->startOfDay();
		$data = $school->logins()->select('login_activities.created_at')
			->latest()
			->whereDate('login_activities.created_at', '>', $startDate)
		    ->get()
		    ->groupBy(function($date) {
		        return Carbon::parse($date->created_at)->startOfDay()->timestamp; // grouping by months
		    })->map(function ($date) {
		    	return $date->count();
		    });

		$end = Carbon::now();

		while($startDate <= $end) {
			if(!array_key_exists( $startDate->timestamp, $data->toArray())) {
			$data[$startDate->timestamp] = 0;
			}

			$startDate->addDay();
		}

		$dataToReturn = [];

		foreach ($data as $date => $dataCount) {
			$dataToReturn[] = ["x" => $date * 1000, "y" => $dataCount];
		}

		return collect($dataToReturn);
	}

}