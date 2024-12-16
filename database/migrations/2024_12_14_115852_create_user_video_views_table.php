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
        Schema::create('user_video_views', function (Blueprint $table) {
                $table->id(); // BIGINT AUTO_INCREMENT PRIMARY KEY
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('video_id');
                $table->string('section_name');
                $table->string('level_name');
                $table->timestamp('viewed_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
                $table->timestamps(); // created_at and updated_at
                // Foreign key constraints
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
    
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_video_views');
    }
};
