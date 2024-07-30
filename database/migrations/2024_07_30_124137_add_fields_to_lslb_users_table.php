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
        Schema::table('lslb_users', function (Blueprint $table) {
            $table->tinyInteger('whatsapp_msg')->default(0);
            $table->string('how_hear_about_us')->nullable();
            $table->text('additional_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lslb_users', function (Blueprint $table) {
            $table->dropColumn('whatsapp_msg');
            $table->dropColumn('how_hear_about_us');
            $table->dropColumn('additional_info');
        });
    }
};
