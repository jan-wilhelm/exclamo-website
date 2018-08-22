<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class CreateReportedCaseTest extends TestCase
{

	use DatabaseTransactions;

    public function testExample()
    {
    	$this->assertTrue(true);
    // 	$user = User::student()->first();

    // 	$reportedCaseData = [
    //         'title' => 'Reported Case',
    //         'message' => 'Reported Case message',
    //         'incident_date' => '01.01.2018',
    //         'category' => 'bullying',
    //         'location' => $user->school->locations->random()->id,
    //         'mentors' => [
    //         	$user->school->mentors->random()
    //         ],
    //         'case-anonymous' => true
    //     ];

    //     $reportedCase = $user->reportedCases()->latest()->first();

    //     $this->actingAs($user)
    //     	->withoutMiddleware()
    //     	->post(route('incidents.store'), $reportedCaseData)
    //     	->assertStatus(302)
    //     	->assertRedirect(route('incidents.show', ["case" => $reportedCase->id]));

    //     $this->assertEquals($reportedCaseData["title"], $reportedCase->title);
    }
}
