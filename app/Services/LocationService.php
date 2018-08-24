<?php

namespace App\Services;

use App\User;

class LocationService
{

    public function getLocationDataForUser(User $user)
    {
        return $user->school->locations->map(function ($location, $index) {
            return [
                'id'=> $location->id,
                'name'=> $location->title
            ];
        });
    }

}