<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();

        DB::table('post_tag')->truncate();

        Tag::factory(100)->create()->pluck('id')->each(function ($id) {
            foreach(range(1, rand(1,5)) as $postId) {
                DB::table('post_tag')->insert([
                    'post_id' => rand(1, 50),
                    'tag_id' => $id,
                ]);
            }
        });
    }
}
