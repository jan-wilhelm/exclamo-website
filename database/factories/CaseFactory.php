<?php

use Faker\Generator as Faker;

$factory->define(App\ReportedCase::class, function (Faker $faker) {
    return [
    	'title' => $faker->firstName . " beats me!",
    	'solved' => $faker->boolean,
    	'updated_at' => (new \DateTime($faker->dateTime()->format('Y-m-d H:i:s'), new \DateTimeZone('UTC')))->setTimezone(new DateTimeZone("Europe/Berlin"))
    ];
});
