<?php

namespace Tests\Unit;

use App\User;
use App\ReportedCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

	use DatabaseTransactions;

	/**
	 * Test that the $user->full_name attribute actually returns the real full name of the user
	 * @return void
	 */
    public function testFullNameAttribute()
    {
        $user = factory(User::class)->make();
        $this->assertEquals($user->full_name, $user->first_name . " " . $user->last_name);
    }

    /**
     * Test that the $user->combined_cases attribute returns all the cases associated to the user,
     * e.g. the cases in which the user is either a mentor or a victim
     * @return void
     */
    public function testCombinedCasesAttribute() {
    	// create the user
        $user = factory(User::class)->create();

        // create the cases where the user is the victim
        $cases = factory(ReportedCase::class, 3)->make();
        $user->reportedCases()->saveMany($cases);

        // create the cases where the user is a mentor
        $mentorCases = factory(ReportedCase::class, 3)->create([
        	'student_id' => factory(User::class)->create()->id
        ])->each(function ($reportedCase) use ($user) {
        		$reportedCase->mentors()->save($user);
        	});
        $user->mentorCases()->saveMany($mentorCases);

        // Check that the combined_cases are really only the mentorcases and victimcases
        collect($cases, $mentorCases)->each(function ($createdCase) use ($user) {
        	$this->assertTrue($user->combined_cases->contains($createdCase));
        });
    }
}
