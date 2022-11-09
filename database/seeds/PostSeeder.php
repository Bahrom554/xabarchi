<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2019, 10, 23, 6, 0, 0);

        for ($i = 1; $i <= 100; $i++) {
            $date->addDays(1);

            $posts[] = [
                'author_id' => 1,
                'title' => $faker->sentence(rand(8, 12)),
                'subtitle' => $faker->text(rand(250, 300)),
                'body' => $faker->paragraphs(rand(10, 15), true),
                'slug' => $faker->slug,
                'file_id' => rand(1, 3),
                'category_id' => rand(1, 20),
                'created_at' => clone ($date),
                'updated_at' => clone ($date),
                'status'=>1,
                'type' => rand(1, 8)
                //                'view_count' => rand(1,10)*10
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
