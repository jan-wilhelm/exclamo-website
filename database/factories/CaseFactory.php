<?php

use Faker\Generator as Faker;

$factory->define(App\ReportedCase::class, function (Faker $faker) {
    return [
    	'title' => $faker->firstName . " beats me!",
    	'solved' => $faker->boolean
    ];
});
