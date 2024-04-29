<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::truncate();

        foreach (range(1, 250) as $item) {
            Post::factory(1)->create([
                'user_id' => rand(1, 10),
            ]);
        }
    }
}
