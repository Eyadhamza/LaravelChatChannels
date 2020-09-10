<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelChatChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('Laravel-Chat-Channels_table', function (Blueprint $table) {
            $table->bigIncrements('id');

            // add fields

            $table->timestamps();
        });
    }
}
