<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id_role' => '1',
            'name' => 'Admin',
            'description' => 'This user can control everything.',
        ]);

        DB::table('roles')->insert([
            'id_role' => '2',
            'name' => 'Customer ',
            'description' => 'This user only controls their restaurants.',
        ]);
    }
}
