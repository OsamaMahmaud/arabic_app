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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->enum('section_name', ['التعلم من الحوار', 'التعلم من القراءه والكتابة', 'التعلم من الصور', 'الاكاديمية']);
            // $table->foreignId('section_id')->constrained('sections')->onDelete('cascade'); // Associated section
            $table->string('title'); // Video title
            $table->text('description')->nullable(); // Video description
            $table->string('image')->nullable();
            $table->string('url'); // Video URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
