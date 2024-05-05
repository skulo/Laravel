<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Character;
use App\Models\Place;
use App\Models\Contest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        User::factory(10)->create();
        $users = User::all();


        Place::factory(10)->create();
        $places = Place::all();


        $characters = Character::factory(10)->create([
            'user_id' => $users->random()->id,

        ]);


        foreach ($characters as $character) {
            $randomUser = $users->random();

            $character->user_id = $randomUser->id;
            $character->enemy = $randomUser->admin ? mt_rand(0, 1) : 0;
            $character->save();
        }


        $contests = Contest::factory(15)->create();



        $contests->each(function ($contest) use ($characters, $places, $users) {
            $character1 = $characters->where('enemy', 0)->random();
            $character2 = $characters->where('enemy', 1)->random();

            $place = $places->random();


            $hp = mt_rand(0, 20);


            $contest->characters()->attach([
                $character1->id => [
                    'hero_hp' => $contest->win ? $hp : 0,
                    'enemy_hp' => $contest->win ? 0 : $hp
                ],
                $character2->id => [
                    'hero_hp' => $contest->win ? $hp : 0,
                    'enemy_hp' => $contest->win ? 0 : $hp
                ],
            ]);

            $contest->place_id = $place->id;
            $contest->user_id = $character1->user_id;
            $contest->save();
        });
    }
}
