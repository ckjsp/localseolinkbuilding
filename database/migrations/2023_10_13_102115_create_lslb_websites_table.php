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
        Schema::create('lslb_websites', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->notNull();
            $table->char('website_url', 255);
            $table->integer('domain_authority')->notNull();
            $table->integer('page_authority')->notNull();
            $table->integer('ahrefs_traffic')->nullable();
            $table->integer('samrush_traffic')->nullable();
            $table->integer('google_analytics')->nullable();
            $table->integer('publishing_time')->notNull();
            $table->integer('minimum_word_count_required')->notNull();
            $table->enum('backlink_type', ['dofollow', 'nofollow']);
            $table->char('maximum_no_of_backlinks_allowed', 50);
            $table->char('domain_life_validity', 50);
            $table->char('sample_post_url', 255);
            $table->longText('guidelines');
            $table->longText('categories');
            $table->integer('guest_post_price')->notNull();
            $table->integer('link_insertion_price')->notNull();
            $table->longText('forbidden_categories');
            $table->integer('fc_guest_post_price')->notNull();
            $table->integer('fc_link_insertion_price')->notNull();
            $table->enum('status', ['pending', 'in-review', 'approve', 'rejected']);
            $table->char('site_verification_file', 500)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_websites');
    }
};
