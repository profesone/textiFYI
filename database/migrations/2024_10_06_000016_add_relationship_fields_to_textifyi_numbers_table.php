<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTextifyiNumbersTable extends Migration
{
    public function up()
    {
        Schema::table('textifyi_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_10167704')->references('id')->on('teams');
        });
    }
}
