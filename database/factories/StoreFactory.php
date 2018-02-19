<?php

$factory->define(App\Store::class, function (Faker\Generator $faker) {
    return [
        "city_id" => factory('App\City')->create(),
        "name" => $faker->name,
        "description" => $faker->name,
        "phone" => $faker->randomNumber(2),
    ];
});
