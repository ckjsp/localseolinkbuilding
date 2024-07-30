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
        Schema::create('lslb_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('role_id');
            $table->string('email')->unique();
            $table->bigInteger('phone_number')->nullable();
            $table->char('dial_code', 10)->nullable();
            $table->char('image', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', [1, 0]);
            $table->enum('identity', ['individual link builder', 'in-house team', 'agency']);
            $table->char('company_website_url', 255)->nullable();
            $table->char('country', 50)->nullable();
            $table->bigInteger('balance')->nullable();
            $table->enum('preferred_method', ['paypal', 'stripe', 'razorpay']);
            $table->string('payment_email')->nullable();
            $table->char('business_name', 50)->nullable();
            $table->char('registration_number', 50)->nullable();
            $table->string('billing_address')->nullable();
            $table->char('billing_city', 50)->nullable();
            $table->char('billing_country', 50)->nullable();
            $table->char('postal_code', 50)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            // $table->foreign('role_id')->references('id')->on('user_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_users');
    }
};
