<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // only run this on dev environment
        if (env('APP_ENV') != 'production') {
            $this->call(DummyDataSeeder::class);
        }
    }
}
