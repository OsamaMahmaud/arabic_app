<?php

namespace Database\Seeders;

use App\Models\ImageSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageSection::create([
            'section_name' => 'التعلم من الحوار',
            'image_path' => 'media/image_sections/التعلم من الحوار.gif',
        ]);

        ImageSection::create([
            'section_name' => 'التعلم من الصور',
            'image_path' => 'media/image_sections/التعلم من الصور.gif',
        ]);

        ImageSection::create([
            'section_name' => 'التعلم من القراءة',
            'image_path' => 'media/image_sections/التعلم من القراءة.gif',
        ]);

        ImageSection::create([
            'section_name' => 'تصريف الافعال',
            'image_path' => 'media/image_sections/تصريف الافعال.gif',
        ]);

        ImageSection::create([
            'section_name' => 'الاكاديمية',
            'image_path' => 'media/image_sections/الاكاديمية.gif',
        ]);
    }
}
