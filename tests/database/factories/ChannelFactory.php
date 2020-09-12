<?php

use \Faker\Generator;
use TheProfessor\Laravelchatchannels\Models\Channel;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Channel::class, function (Generator $faker) {
    return [
        'name' => 'something',
        'description' => 'description for something',
    ];
});
