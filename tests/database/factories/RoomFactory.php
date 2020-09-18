<?php

use \Faker\Generator;
use TheProfessor\Laravelrooms\Models\Room;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Room::class, function (Generator $faker) {
    return [
        'name' => 'something',
        'description' => 'description for something',
    ];
});
