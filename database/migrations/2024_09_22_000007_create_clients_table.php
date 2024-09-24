<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->string('company_name')->nullable();
            $table->string('main_contact_number');
            $table->string('email')->unique();
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
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
