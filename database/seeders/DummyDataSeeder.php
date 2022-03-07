<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{

    public function run()
    {
        $users = User::factory(10)->create()->pluck('id')->toArray();
        foreach ($users as $userId) {
            $postsCount = random_int(10, 15);
            Post::factory($postsCount)->create(['user_id' => $userId]);
        }

        $users2 = User::factory(10)->create()->pluck('id')->toArray();
        foreach ($users2 as $userId) {
            Post::factory(5)->create(['user_id' => $userId]);
        }
    }
}
