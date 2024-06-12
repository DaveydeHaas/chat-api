<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chatroom>
 */
class ChatroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'is_private' => 0,
            'enabled' => 1,
            'key' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
