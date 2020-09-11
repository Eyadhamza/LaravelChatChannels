<?php

use \Faker\Generator;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;
use TheProfessor\Laravelchatchannels\Models\User;


/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Participant::class, function (Generator $faker) {
    return [
        'participatable_type'=>'TheProfessor\Laravelchatchannels\Models\User',
        'participatable_id'=>User::create(['name'=>'eyad'])->id,
        //only for testing
        //the package can work on different models
    ];
});
