<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class LoginPageTest extends TestCase
{

	use DatabaseTransactions;

    public function testUnauthenticatedUserCanSeeTheLoginPage()
    {
    	$this->withoutExceptionHandling()->get(route('login'))
        	->assertStatus(200)
        	->assertSee('Login');
    }

    public function testUnauthenticatedUserCanLogin()
    {
        $this->withoutMiddleware();

    	$user = factory(User::class)->create([
    		"password" => "secret"
    	]);

    	$credentials = [
    		"email" => $user->email,
    		"password" => 'secret'
    	];

    	$this->post('/login', $credentials)
    		->assertStatus(302);
    }

    public function testAuthenticatedUserGetsRedirected()
    {
    	$this->actingAs(factory(User::class)->create())
    		->get('/login')
    		->assertStatus(302);
    }
}
