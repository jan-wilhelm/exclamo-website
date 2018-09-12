<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    protected $usersService;

    public function __construct(UserService $usersService)
    {
        $this->middleware('auth:api');
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validate([
            'first_name'=> 'sometimes|string',
            'last_name'=> 'sometimes|string',
            'email'=> 'sometimes|email',
            'mentoring'=> 'sometimes|boolean'
        ]);

        $user->fill($validated);
        $user->save();

        return $this->show($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->messages()->delete();
        $user->logins()->delete();
        $user->reportedCases->each(function ($reportedCase) {
            $reportedCase->messages()->delete();
            $reportedCase->mentors()->detach();
        });
        $user->mentorCases->each(function ($reportedCase) {
            $reportedCase->messages()->delete();
            $reportedCase->mentors()->detach();
        });
        $user->reportedCases()->delete();
        $user->mentorCases()->delete();
        $user->delete();
    }
}
