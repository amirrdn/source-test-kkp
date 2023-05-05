<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'name' => 'Admin',
                'guard_name' => 'api',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'name' => 'Member',
                'guard_name' => 'api',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ];
        Role::insert($role);
    }
}
