<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domain = url('');
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            if ($i < 5) {
                $image = $domain.'/front-end/images/news-img.png';
            } else {
                $image = $domain.'/front-end/images/news-slider-img.png';
            }
            Page::create([
                'type' => 'blog',
                'title' => $faker->sentence($nbWords = 20, $variableNbWords = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'image' => $image,
                'release' => rand(0,1),
                'release_date' => \Carbon\Carbon::now(),
                'public' => rand(0,1),
                'public_destination' => $domain,
                'owner_id' => 1
            ]);
        }

        $file = $domain.'/front-end/files/demo.docx';;
        
        for ($i = 0; $i < $limit; $i++) {
            
            Page::create([
                'type' => 'manual',
                'title' => $faker->sentence($nbWords = 20, $variableNbWords = true),                
                'release' => rand(0,1),
                'release_date' => \Carbon\Carbon::now(),
                'public' => rand(0,1),
                'public_destination' => $domain,
                'files' => json_encode([$file]),
                'owner_id' => 1
            ]);
        }
                
        for ($i = 0; $i < $limit; $i++) {
            
            Page::create([
                'type' => 'faq',
                'title' => $faker->sentence($nbWords = 20, $variableNbWords = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),                
                'release' => rand(0,1),
                'release_date' => \Carbon\Carbon::now(),
                'public' => rand(0,1),
                //'public_destination' => $domain,                
                'owner_id' => 1
            ]);
        }

    }
}
