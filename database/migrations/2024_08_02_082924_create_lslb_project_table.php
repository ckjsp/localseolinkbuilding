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
        Schema::create('lslb_project', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->char('project_url', 255);
            $table->json('categories');
            $table->json('forbidden_category');
            $table->text('additional_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lslb_project');
    }
};
