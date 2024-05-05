<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {
        $totalPoints = 20;
        $defence = $this->faker->numberBetween(0, 3);
        $strength = $this->faker->numberBetween(0, $totalPoints - $defence);
        $accuracy = $this->faker->numberBetween(0, $totalPoints - $strength - $defence);
        $magic = $totalPoints - $strength - $accuracy - $defence;

        return [
            'name' => $this->faker->name,
            'enemy' => $this->faker->boolean(50),
            'defence' => $defence,
            'strength' => $strength,
            'accuracy' => $accuracy,
            'magic' => $magic,
        ];
    }
}
