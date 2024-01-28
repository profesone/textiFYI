<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('text_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('campaign');
            $table->longText('response');
            $table->longText('notes')->nullable();
            $table->string('notification_main')->nullable();
            $table->string('notification_01')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
