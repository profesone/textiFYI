<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKeywordsTable extends Migration
{
    public function up()
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_9314973')->references('id')->on('clients');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9314977')->references('id')->on('teams');
        });
    }
}
