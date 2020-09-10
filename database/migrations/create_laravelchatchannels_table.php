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

            $table->timestamps();
        });
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
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
    }
}
