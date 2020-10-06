<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();
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
                'title' => $faker->sentence($nbWords = 15, $variableNbWords = true),
                'summary' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'image' => $image,
                'public' => rand(0,1),
                'public_date' => \Carbon\Carbon::now(),
                'status' => rand(0,1),
                'url' => $domain,
                'owner_id' => 1
            ]);
        }

        $file = 'https://s3.us-east-2.amazonaws.com/clinic.dev/pages/files/2020100322e762389774ff21899ecf910d5e685c29/VknGWJXiqqhEfM28iZjUfg9YB33eLWvwVJgQrT4D.pdf';

        for ($i = 0; $i < $limit; $i++) {

            Page::create([
                'type' => 'manual',
                'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
                'public' => rand(0,1),
                'public_date' => \Carbon\Carbon::now(),
                'status' => rand(0,1),
                'url' => $domain,
                'files' => json_encode([
                    'name' => 'Yuushingai.pdf',
                    'path' => $file,
                    'size' => '7.54MB',
                    'extension' => 'pdf'
                ]),
                'owner_id' => 1
            ]);
        }

        for ($i = 0; $i < $limit; $i++) {

            Page::create([
                'type' => 'faq',
                'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'public' => rand(0,1),
                'public_date' => \Carbon\Carbon::now(),
                'status' => rand(0,1),
                //'public_destination' => $domain,
                'owner_id' => 1
            ]);
        }

    }
}
