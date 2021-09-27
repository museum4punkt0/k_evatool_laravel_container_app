<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            UserFactory::times(1)->admin()->create();
        }

        UserFactory::times(2)->create();
        UserFactory::times(2)->unverified()->create();

    }
}
