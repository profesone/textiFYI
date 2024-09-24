<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeywordTextResponsePivotTable extends Migration
{
    public function up()
    {
        Schema::create('keyword_text_response', function (Blueprint $table) {
            $table->unsignedBigInteger('text_response_id');
            $table->foreign('text_response_id', 'text_response_id_fk_9396979')->references('id')->on('text_responses')->onDelete('cascade');
            $table->unsignedBigInteger('keyword_id');
            $table->foreign('keyword_id', 'keyword_id_fk_9396979')->references('id')->on('keywords')->onDelete('cascade');
        });
    }
}
