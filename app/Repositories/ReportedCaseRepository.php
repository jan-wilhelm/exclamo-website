<?php

namespace App\Repositories;

use App\ReportedCase;
use App\User;
use App\Location;
use App\Message;
use App\Repositories\RepositoryInterface;

class ReportedCaseRepository implements RepositoryInterface
{
	
	public function all()
	{
		return ReportedCase::all();
	}
 
    public function paginate($perPage = 20)
    {
    	return ReportedCase::paginate($perPage);
    }

    public function simplePaginate($perPage = 20)
    {
    	return ReportedCase::simplePaginate($perPage);
    }
 
    public function create(array $data)
    {
    	return ReportedCase::create($data);
    }
 
    public function make(array $data)
    {
        return ReportedCase::make($data);
    }
 
    public function update($id, array $data)
    {
    	return ReportedCase::find($id)->update($data);
    }

    public function delete($id)
    {
    	ReportedCase::destroy($id);
    }
 
    public function find($id)
    {
    	return ReportedCase::find($id);
    }

    public function ofUser(User $user)
    {
    	return $user->reportedCases();
    }

    public function whereMentoring(User $user)
    {
    	return $user->mentorCases();
    }

    public function resolved($cases)
    {
        return $cases->filter(function($value, $key) {
            return $value->solved; // Get only the cases which are already resolved
        });
    }

    public function open($cases)
    {
        return $cases->reject(function($value, $key) {
            return $value->solved; // Get only the cases which are already resolved
        });
    }

    public function getWithData(User $user, $cases = null)
    {
        $cases = $cases ?: $this->ofUser($user);
        return $cases->with([
            'mentors',
            'messages' => function($query) {
                $query->orderBy('updated_at', 'desc');
            }
        ]);
    }

}