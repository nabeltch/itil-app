<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'type'=>'admin',
            'password' => bcrypt('12345678'),
        ]);
        \App\Models\User::create([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'type'=>'client',
            'password' => bcrypt('12345678'),
        ]);
        \App\Models\User::create([
            'name' => 'soporte',
            'email' => 'soporte@gmail.com',
            'type'=>'support',
            'password' => bcrypt('12345678'),
        ]);
    }
}
