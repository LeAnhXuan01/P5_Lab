<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $authors = ['Nhacvietplus', 'LEE XUAN', 'LEE HYOKE', 'XUAN LEE', 'XUAN'];

        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'name' => $author,
                'image' => $faker->imageUrl(200, 200, 'people', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
