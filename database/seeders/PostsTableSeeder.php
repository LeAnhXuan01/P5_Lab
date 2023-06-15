<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            $title = $faker->sentence(6);
            $summary = $faker->paragraph(3);
            $content = $faker->paragraphs(5, true);
            $image = $faker->imageUrl(800, 400, 'nature', true);

            DB::table('posts')->insert([
                'title' => $title,
                'song_name' => $faker->word,
                'category_id' => $faker->numberBetween(1, 5),
                'summary' => $summary,
                'content' => $content,
                'author_id' => $faker->numberBetween(1, 5),
                'written_date' => $faker->dateTimeThisYear(),
                'image' => $image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
