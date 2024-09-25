<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTextifyiNumbersTable extends Migration
{
    public function up()
    {
        Schema::table('textifyi_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9360078')->references('id')->on('teams');
        });
    }
}
