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
        Schema::create('gallery_image_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_image_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->timestamps();
            
            $table->unique(['gallery_image_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_image_categories');
    }
};
