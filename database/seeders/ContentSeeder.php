<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            $contentData[] = [
                'name' => Str::random(10),
                'description' => Str::random(10),
                'attachment' => Str::random(10),
                'datefrom' => date('Y-m-d'),
                'dateto' => date('Y-m-d'),
                'course_id' => \App\Models\Course::all('id')->random()->id,
                'user_id' =>  \App\Models\User::all('id')->random()->id,
                'status' => 1,
                'visibility' => 1,
                'sort' => strtotime("now"),
            ];
        }  
        
        foreach ($contentData as $content) {
            Content::create($content);
        }
    }
}
