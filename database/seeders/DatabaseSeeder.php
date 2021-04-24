<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Roles;
use Database\Seeders\UserAdmin;
use Database\Seeders\RolesUsers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		$this->call(Roles::class);
	   	$this->call(UserAdmin::class);
        $this->call(RolesUsers::class);
    }
}
