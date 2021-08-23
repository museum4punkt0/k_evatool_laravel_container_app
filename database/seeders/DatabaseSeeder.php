<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Twoavy\EvaluationTool\Seeders\EvaluationToolSeeder;
use Twoavy\EvaluationTool\Seeders\EvaluationToolDemoDataSeeder;

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
             EvaluationToolSeeder::class,
             EvaluationToolDemoDataSeeder::class
        ]);
    }
}
