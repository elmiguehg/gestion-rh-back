<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users= User::all();

        return [
            'name'=> $this -> faker -> name(),
            'last_name'=> $this -> faker -> lastName(),
            'dni'=> $this -> faker ->numberBetween(123456789,987654321),
            'birthdate'=> $this -> faker -> date(),
            'address'=> $this -> faker -> sentence(5),
            'foto'=> $this -> faker -> text(),
            'user_id'=> $this -> faker ->unique() -> numberBetween(1, $users->count()),
        ];
    }
}
