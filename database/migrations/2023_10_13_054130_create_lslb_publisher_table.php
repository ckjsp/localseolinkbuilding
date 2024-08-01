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
        Schema::create('lslb_publishers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->notNull();
            $table->char('website_url', 255);
            $table->integer('domain_authority')->notNull();
            $table->char('publishing_time', 100);
            $table->integer('minimum_word_count_required')->notNull();
            $table->enum('backlink_type', ['dofollow', 'nofollow']);
            $table->char('maximum_no_of_backlinks_allowed', 50);
            $table->char('domain_life_validity', 50);
            $table->char('sample_post_url', 255);
            $table->longText('guidelines');
            $table->longText('categories');
            $table->integer('guest_post_price')->notNull();
            $table->integer('link_insertion_price')->notNull();
            $table->longText('select_the_forbidden_categories_you_accept');
            $table->integer('fc_guest_post_price')->notNull();
            $table->integer('fc_link_insertion_price')->notNull();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_publishers');
    }
};
