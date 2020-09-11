<?php

use \Faker\Generator;
use TheProfessor\Laravelchatchannels\Models\Chat;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Chat::class, function (Generator $faker) {
    return [
        'name' => 'something',
        'description' => 'description for something',
    ];
});
