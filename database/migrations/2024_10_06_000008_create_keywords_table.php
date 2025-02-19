<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordsTable extends Migration
{
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('text_response_id');
            $table->foreign('text_response_id', 'response_fk_9314928')
                ->references('id')->on('text_response');
            $table->string('keyword');
            $table->timestamps();
        });
    }
}
