<?php

namespace App\Services;

use App\User;
use App\Location;
use App\Message;
use App\Repositories\ReportedCaseRepository;

class ReportedCaseService
{

	public $cases;

	public function __construct(ReportedCaseRepository $cases)
	{
		$this->cases = $cases;
	}

    /**
     * Get the case statistics for a specified user
     * @param  User   $user          The user
     * @param  array $cases         The subset of cases of which the data should be included in the stats
     * @param  array $resolvedCases The subset of the $cases argument which are already resolved
     * @return array                An array with the statistics
     */
    public function getStatistics(User $user, $cases)
    {
        return [
            'numberOfCases' => $cases[0]->count() + $cases[1]->count(),
            'numberOfResolvedCases' => $cases[1]->count(),
            'numberOfMessages' => $user->messages()->count()
        ];
    }

    public function getOrderedForView(User $user, $cases = null)
    {
        // Get the Reported Cases along with their assigned mentors which can
        // then be display in the view.
        // This is a lot more performent than fetching each case's mentors,
        // since larger SQL queries are generally faster than a lot of smaller
        // queries
        $cases = $this->cases->getWithData($user, $cases)
            ->orderBy('updated_at', 'desc')
            ->get();
        $resolvedCases = $this->cases->resolved($cases) ?: array();
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

        $case = $this->cases->make($params);
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