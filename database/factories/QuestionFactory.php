<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->realText($maxNbChars = 500, $indexSize = 2),
            'category_id' => Category::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}