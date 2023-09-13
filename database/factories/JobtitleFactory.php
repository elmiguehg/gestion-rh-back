<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobtitle>
 */
class JobtitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::all()->random();
        return [
            'name'=> $this -> faker -> name(),
            'importance'=> $this -> faker -> numberBetween(1,10),
            'is_boss'=> $this -> faker -> boolean(),
            'category_id' => $category->id
        ];
    }
}
