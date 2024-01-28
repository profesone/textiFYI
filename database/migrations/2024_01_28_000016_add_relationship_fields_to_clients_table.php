<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('texti_fyi_number_id')->nullable();
            $table->foreign('texti_fyi_number_id', 'texti_fyi_number_fk_9314949')->references('id')->on('textifyi_numbers');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9314970')->references('id')->on('teams');
        });
    }
}
