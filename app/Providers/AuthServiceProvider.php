<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use Illuminate\Support\Facades\Crypt;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Message' => 'App\Policies\MessagePolicy',
        'App\ReportedCase' => 'App\Policies\ReportedCasePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::viaRequest('token-and-cookie', function ($request) {
            $apiToken = Crypt::decryptString(Cookie::get('api_token'));
            $token = $request->query('api_token', $apiToken);
            $user = User::where('api_token', $token)->first();
            return $user;
        });
    }
}
