<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTextifyiNumberPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_textifyi_number', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_10137880')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('textifyi_number_id');
            $table->foreign('textifyi_number_id', 'textifyi_number_id_fk_10137880')->references('id')->on('textifyi_numbers')->onDelete('cascade');
        });
    }
}
