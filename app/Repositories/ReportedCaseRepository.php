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

    /**
     * Creates and stores a new ReportedCase with the given parameters
     *
     * Note that the $user should be authorized to perform this action
     * as this method does not check for that.
     * @param  array    $params     An array of fields for the case
     * @param  User|null $user       The creator of the new case
     * @param  array    $categories An array containing the possible categories of a case
     * @return ReportedCase                The created case
     */
    public function createReportedCase($params, User $user = null, $categories)
    {
        $mentorIDs = $params['mentors'];
        $params['anonymous'] = isset($params["anonymous"]) && (is_bool($params["anonymous"]) ? boolval($params["anonymous"]) : true);

        $case = $this->make($params);
        $case->victim()->associate($user);
        $case->location()->associate(Location::find($params['location']));
        $case->save();

        // Add the selected mentors to the case
        $case->mentors()->saveMany(User::find($mentorIDs));

        // Create the initial message from the description text
        // and add it to the case
        $initialMessage = Message::make([
            "body"=> $params["message"]
        ]);
        $initialMessage->user_id = $user->id;
        $initialMessage->reportedCase()->associate($case);
        $initialMessage->save();

        return $case;
    }

}