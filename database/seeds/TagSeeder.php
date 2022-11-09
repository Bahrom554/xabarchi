<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = [];
        factory(Tag::class, 100)->create();
        for ($i = 1; $i <= 100; $i++) {
            $tag[] = [
                'post_id' => rand(1, 100),
                'tag_id' => rand(1, 100)
            ];
        }

        DB::table('post_tags')->insert($tag);
    }
}
