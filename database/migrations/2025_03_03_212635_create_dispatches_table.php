<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required();
            $table->longText('default_message')->nullable();
            $table->longText('default_request_message')->nullable();
            $table->longText('default_zipcode_message')->nullable();
            $table->longText('email_address_response')->nullable();
            $table->boolean('default_messages_module')->default(0)->nullable();
            $table->boolean('default_message_notification')->default(0)->nullable();
            $table->boolean('default_message_response')->default(0)->nullable();
            $table->boolean('publish_keywords_module')->default(0)->nullable();
            $table->boolean('leads_module')->default(0)->nullable();
            $table->boolean('keyword_module')->default(0)->nullable();
            $table->boolean('mls_listing_module')->default(0)->nullable();
            $table->boolean('mls_agent_notification')->default(0)->nullable();
            $table->boolean('tips_request_module')->default(0)->nullable();
            $table->boolean('zip_code_module')->default(0)->nullable();
            $table->boolean('default_zip_notification')->default(0)->nullable();
            $table->boolean('email_address_module')->default(0)->nullable();
            $table->boolean('default_email_notification')->default(0)->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->boolean('active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
