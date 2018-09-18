<?php

use Faker\Generator as Faker;

$factory->define(App\LoginActivity::class, function (Faker $faker) {
    return [
        'user_agent'=> $faker->userAgent,
        'ip_address'=> $faker->ipv4,
    	'created_at' => (new \DateTime($faker->dateTimeThisYear()->format('Y-m-d H:i:s'), new \DateTimeZone('UTC')))->setTimezone(new DateTimeZone("Europe/Berlin"))
    ];
});
