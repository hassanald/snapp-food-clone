<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Role::factory()->create(['title' => 'admin']);
        Role::factory()->create(['title' => 'seller']);
        Role::factory()->create(['title' => 'user']);

         \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'phone' => '09212776349',
             'password' => bcrypt(12345678),
             'role_id' => 1,
         ]);
    }
}
