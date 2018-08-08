<?php

namespace App\Repositories;

use App\ReportedCase;
use App\User;
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

    public function getOrderedForView(User $user, $cases = null)
    {
        // Get the Reported Cases along with their assigned mentors which can
        // then be display in the view.
        // This is a lot more performent than fetching each case's mentors,
        // since larger SQL queries are generally faster than a lot of smaller
        // queries
        $cases = $this->getWithData($user, $cases)
            ->orderBy('updated_at', 'desc')
            ->get();

        $resolvedCases = $this->resolved($cases) ?: array();
        $unresolvedCases = $cases->diff($resolvedCases) ?: array();

        return [$unresolvedCases, $resolvedCases];
    }

}