<?php

use \Faker\Generator;
use TheProfessor\Laravelrooms\Models\Message;
use TheProfessor\Laravelrooms\Models\Participant;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Message::class, function (Generator $faker) {
    return [
        'body' => 'body of the message',
        'sender_id' => factory(Participant::class),
    ];
});
