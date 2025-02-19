<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTextResponsesTable extends Migration
{
    public function up()
    {
        Schema::table('text_responses', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'user_fk_9360208')->references('id')->on('users');
            $table->unsignedBigInteger('main_keyword_id')->nullable();
            $table->foreign('main_keyword_id', 'main_keyword_fk_9422363')->references('id')->on('keywords');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9315149')->references('id')->on('teams');
        });
    }
}
