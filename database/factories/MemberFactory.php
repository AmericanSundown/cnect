<?php

use Faker\Generator as Faker;

$factory->define(App\Member::class, function (Faker $faker) {
    return [
        'nickname' => $faker->userName,
        'total' => $faker->randomDigitNotNull
    ];
});
