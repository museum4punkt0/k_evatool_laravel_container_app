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
        if (env('ADMIN_EMAIL', false) && env('ADMIN_PASSWORD', false)) {
            $user = UserFactory::times(1)->admin()->create();
            $user->first()->attachRoles(["admin"]);
        }

        UserFactory::times(2)->create();
        UserFactory::times(2)->unverified()->create();

    }
}
