<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'uses_dates' => $faker->boolean,
        'uses_locations' => $faker->boolean
    ];
});
