<?php

namespace App\Services;

use App\User;
use App\Repositories\ReportedCaseRepository;

class ReportedCaseService
{

	protected $cases;

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

}