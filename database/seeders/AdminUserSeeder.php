<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => '4mir.rdn@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'status' => 1,
            'role_id' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
