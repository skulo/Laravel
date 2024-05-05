<?php
namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Contest;
use App\Models\User;
use App\Models\Place; 
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    protected $model = Contest::class;

    public function definition()
    {
        return [
        'win' => $this->faker->boolean(),
        'history' => $this->faker->text,
        'user_id' => 1,
         'place_id' => 1,

    ];
}
}