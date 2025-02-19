<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTextifyiNumberPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_textifyi_number', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_10137880')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('textifyi_number_id');
            $table->foreign('textifyi_number_id', 'textifyi_number_id_fk_10137880')->references('id')->on('textifyi_numbers')->onDelete('cascade');
        });
    }
}
