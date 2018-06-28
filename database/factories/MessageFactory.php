<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
    	'body'=> $faker->text(),
    	'updated_at' => (new \DateTime($faker->dateTime()->format('Y-m-d H:i:s'), new \DateTimeZone('UTC')))->setTimezone(new DateTimeZone("Europe/Berlin"))
    ];
});
