<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'test123@gmail.com',
            'password' => bcrypt('sukses123'),
            'level' => 'Super Admin',
        ]);
    }
}
