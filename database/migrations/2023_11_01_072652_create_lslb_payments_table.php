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
        Schema::create('lslb_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->notNull();
            $table->integer('order_id')->notNull();
            $table->integer('payment_amount')->notNull();
            $table->char('payment_id', 255);
            $table->char('payment_method', 50);
            $table->char('payment_type', 50);
            $table->text('payment_responce')->notNull();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_payments');
    }
};
