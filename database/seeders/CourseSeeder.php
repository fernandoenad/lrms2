<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            $courseData[] = [
                'name' => Str::random(10),
                'category_id' => \App\Models\Category::all('id')->random()->id,
                'user_id' =>  \App\Models\User::all('id')->random()->id,
                'visibility' => 1,
                'sort' => strtotime("now"),
            ];
        }  
        
        foreach ($courseData as $course) {
            Course::create($course);
        }
    }
}
