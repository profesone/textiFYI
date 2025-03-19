<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('text_responses', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('dispatch_id');
            $table->longText('response')->nullable();
            $table->longText('notes')->nullable();
            $table->json('notification_numbers')->nullable();
            $table->json('keywords')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->foreign('dispatch_id')->references('id')->on('dispatches')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('contacts', function (Blueprint $table)
        {            
            $table->foreign('text_response_id')->references('id')->on('text_responses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_responses');
    }
};
