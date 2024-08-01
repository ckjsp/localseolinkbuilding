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
        Schema::create('lslb_orders', function (Blueprint $table) {
            $table->id();
            $table->char('order_id', 255)->notNull();
            $table->integer('website_id')->notNull();
            $table->integer('u_id')->notNull();
            $table->integer('price')->notNull();
            $table->integer('quantity')->notNull();
            $table->char('type', 255);
            $table->date('order_date')->notNull();
            $table->timestamp('delivery_time')->nullable();
            $table->enum('status',['new', 'in-progress', 'delayed', 'approved', 'complete', 'rejected']);
            $table->enum('payment_method', ['paypal', 'stripe', 'razorpay']);
            $table->enum('payment_status', ['pending', 'progressing', 'success', 'failed']);
            $table->char('attachment', 255);
            $table->text('article_title')->nullable();
            $table->text('special_instructions')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_orders');
    }
};
