<?php

namespace Database\Seeders;

use App\Models\Chatroom;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Davey',
            'email' => 'davey@example.com',
            'password' => bcrypt('WachtP00rt'),
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Chatroom::factory()->create([
            'title' => 'AMD leaks',
            'description' => 'Talking about potential leaks of new amd processor',
            'is_private' => 0,
            'enabled' => 1,
            'key' => '03veni',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
