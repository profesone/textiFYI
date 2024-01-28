<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextifyiNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('textifyi_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('textifyi_numbers')->unique();
            $table->boolean('used')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
