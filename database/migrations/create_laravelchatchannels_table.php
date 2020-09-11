<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelchatchannelsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('participatable');
            $table->timestamps();
        });
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->boolean('isAdmin')->default('false');
            $table->boolean('isSeen')->default('false');
            $table->boolean('isSender')->default('false');
            $table->timestamps();
        });
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->boolean('isAdmin')->default('false');
            $table->boolean('isSeen')->default('false');
            $table->boolean('isSender')->default('false');
            $table->timestamps();
        });
        Schema::create('chat_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('chat_id')->constrained()->onDelete('cascade');
            $table->foreignId('participant_id');
            $table->timestamps();
        });
        Schema::create('channel_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('channel_id')->constrained()->onDelete('cascade');
            $table->foreignId('participant_id');
            $table->timestamps();
        });
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('body');
            $table->morphs('messagable');
            $table->foreignId('sender_id');
            $table->timestamps();
        });

        //to be deleted only for testing
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}
