<?php

use \Faker\Generator;
use TheProfessor\Laravelrooms\Models\Participant;
use TheProfessor\Laravelrooms\Models\User;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Participant::class, function (Generator $faker) {
    return [
        'participatable_type' => 'TheProfessor\Laravelrooms\Models\User',
        'participatable_id' => User::create(['name' => 'eyad'])->id,
        //only for testing
        //the package can work on different models
    ];
});
