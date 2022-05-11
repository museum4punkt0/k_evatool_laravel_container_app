<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class SeedRolesAndUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'admin')) {

            $admin = new Role();
            $admin->fill(array('name' => 'admin', 'display_name' => 'Admin', 'description' => 'complete control'));

            $userCreator = new Role();
            $userCreator->fill(array('name' => 'userCreator', 'display_name' => 'User Management', 'description' => 'Can create new users'));

            $basicUser = new Role();
            $basicUser->fill(array('name' => 'basicUser', 'display_name' => 'Basic User', 'description' => 'The basic user'));

            $createUser = new Permission();
            $createUser->fill(array('name' => 'createUser', 'display_name' => 'Create a user', 'description' => 'Allows to create new user'));

            $deleteUser = new Permission();
            $deleteUser->fill(array('name' => 'deleteUser', 'display_name' => 'Delete a user', 'description' => 'Allows to delete a user'));

            $admin->save();
            $userCreator->save();
            $basicUser->save();
            $createUser->save();
            $deleteUser->save();

            $admin->attachPermissions([$deleteUser, $createUser]);
            $userCreator->attachPermission($createUser);

            User::where("admin", true)->each(function ($user) {
                $user->attachRoles(["admin"]);
            });

            Schema::table('users', function ($table) {
                $table->dropColumn('admin');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->boolean('admin');
        });
    }
}
