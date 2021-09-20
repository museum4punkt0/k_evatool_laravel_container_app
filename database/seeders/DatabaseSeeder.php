<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Twoavy\EvaluationTool\Seeders\EvaluationToolSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class
        ]);

        $this->call([
             EvaluationToolSeeder::class
        ]);

        Artisan::call('passport:install');

    }
}
