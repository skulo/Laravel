<?php


namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Contest;
use App\Models\User;


class CharacterController extends Controller
{
    public function index()

    {

        if (!auth()->user()) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = auth()->user()->admin;


        if ($isAdmin) {
            $characters = Character::where('user_id', auth()->id())->orWhere('enemy', true)->get();
        } else {

            $characters = auth()->user()->characters;
        }



        return view('characters', compact('characters'));
    }

    public function show(Character $character)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = auth()->user()->admin;

        if ($isAdmin) {
            if (!$character->enemy && $character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        } else {
            if ($character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }





        return view('character-details', compact('character'));
    }



    public function create()
    {

        if (!auth()->user()) {
            abort(403, 'Unauthorized');
        }

        return view('create-character');
    }


    public function store(Request $request)
    {
        if (!auth()->user()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
            'enemy' => 'nullable|boolean',
            'user_id' => 'required|integer',
        ]);


        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;

        if ($totalPoints !== 20) {
            return back()->withInput()->withErrors(['error' => 'Total points must be 20.']);
        }

        Character::create([
            'name' => $request->name,
            'defence' => $request->defence,
            'strength' => $request->strength,
            'accuracy' => $request->accuracy,
            'magic' => $request->magic,
            'enemy' => $request->enemy,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('characters.index')->with('success');
    }

    public function edit(Character $character)
    {
        $isAdmin = auth()->user()->admin;

        if ($isAdmin) {
            if (!$character->enemy && $character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        } else {
            if ($character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }


        return view('characteredit', compact('character'));
    }

    public function update(Request $request, Character $character)
    {

        $isAdmin = auth()->user()->admin;

        if ($isAdmin) {
            if (!$character->enemy && $character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        } else {
            if ($character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }


        $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
            'enemy' => 'nullable|boolean',
        ]);

        $totalPoints = $request->defence + $request->strength + $request->accuracy + $request->magic;

        if ($totalPoints !== 20) {
            return back()->withInput()->withErrors(['error' => 'Total points must be 20.']);
        }

        $character->update([
            'name' => $request->name,
            'defence' => $request->defence,
            'strength' => $request->strength,
            'accuracy' => $request->accuracy,
            'magic' => $request->magic,
            'enemy' => $request->enemy,
        ]);

        return redirect()->route('characters.index')->with('success');
    }

    public function destroy(Character $character)
    {

        $isAdmin = auth()->user()->admin;

        if ($isAdmin) {
            if (!$character->enemy && $character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        } else {
            if ($character->user_id !== auth()->id()) {
                abort(403, 'Unauthorized');
            }
        }

        $contests = $character->contests;
        foreach ($contests as $contest) {
            $contest->delete();
        }

        $character->delete();

        return redirect()->route('characters.index')->with('success');
    }

    public function createContest(Character $character)
    {

        if ($character->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }


        $place = Place::inRandomOrder()->first();
        $enemy = Character::where('id', '!=', $character->id)
            ->where('enemy', true)
            ->inRandomOrder()
            ->first();

        if (!$place || !$enemy) {
            return back()->withErrors(['error' => 'Unable to create contest.']);
        }

        $contest = Contest::create([
            'user_id' =>  auth()->id(),
            'place_id' => $place->id,

        ]);




        $contest->characters()->attach([
            $character->id => [
                'hero_hp' => 20,
                'enemy_hp' => 20
            ],
            $enemy->id => [
                'hero_hp' => 20,
                'enemy_hp' => 20
            ],
        ]);

        return redirect()->route('contest.show', $contest->id);
    }
}
