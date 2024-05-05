<?php
namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
        ];
    }
}