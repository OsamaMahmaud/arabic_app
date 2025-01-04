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
        Schema::table('videos', function (Blueprint $table) {
            if (Schema::hasColumn('videos', 'section_name')) {
                $table->dropColumn('section_name'); // حذف العمود القديم إذا كان موجودًا
            }
        });
    
        Schema::table('videos', function (Blueprint $table) {
            $table->enum('section_name', [
                'التعلم من الحوار', 
                'التعلم من القراءه والكتابة', 
                'التعلم من الصور', 
                'الاكاديمية', 
                'تصريف الأفعال'
            ])->after('level_id'); // إعادة إنشاء العمود مع القيم الجديدة
        });
    }
    
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('section_name'); // حذف العمود الجديد في حال التراجع
        });
    
        Schema::table('videos', function (Blueprint $table) {
            $table->enum('section_name', [
                'التعلم من الحوار', 
                'التعلم من القراءه والكتابة', 
                'التعلم من الصور', 
                'الاكاديمية'
            ])->after('level_id'); // إعادة إنشاء العمود بالقيم القديمة
        });
    }
    
};
