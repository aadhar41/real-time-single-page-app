<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Reply;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'reply_id' => Reply::pluck('id')->random(),
        ];
    }
}