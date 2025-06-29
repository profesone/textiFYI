<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
return new class extends Migration
{
=======
return new class extends Migration {
>>>>>>> bc56ba98ebe909843f88087c16cdde2e667dbec7
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
<<<<<<< HEAD
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->default(3);
=======
            $table->string('email')->unique()->required();
            $table->string('phone')->required();
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('description')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->enum('roles', ['admin', 'lead_agent', 'agent', 'client'])->default('client');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(1);
>>>>>>> bc56ba98ebe909843f88087c16cdde2e667dbec7
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
<<<<<<< HEAD
=======
        Schema::dropIfExists('teams');
>>>>>>> bc56ba98ebe909843f88087c16cdde2e667dbec7
    }
};
