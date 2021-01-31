<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Download;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            $downloadData[] = [
                'content_id' => \App\Models\Content::all('id')->random()->id,
                'user_id' =>  \App\Models\User::all('id')->random()->id,
            ];
        }  
        
        foreach ($downloadData as $download) {
            Download::create($download);
        }
    }
}
