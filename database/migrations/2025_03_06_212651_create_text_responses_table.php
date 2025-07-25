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
            $table->string('title')->required();
            $table->longText('response')->nullable();
            $table->longText('notes')->nullable();
            $table->json('notification_numbers')->nullable();
            $table->json('keywords')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(false);
            $table->foreign('dispatch_id')->references('id')->on('dispatches')->onDelete('cascade');
            $table->timestamps();
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
