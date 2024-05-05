<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Contest;
use App\Models\User;


class ContestController extends Controller
{
    public function show(Contest $contest)
    {
        $character = $contest->characters->where('enemy', false)->first();
        $enemy = $contest->characters->where('enemy', true)->first();
        $isAdmin = auth()->user()->admin;

        if (!$isAdmin) {
            if (!auth()->user() || (auth()->id() != $character->user_id && auth()->id() != $enemy->user_id)) {
                return abort(403, 'Unauthorized');
            }
        } else {
            if (!auth()->user()) {
                abort(403, 'Unauthorized');
            }
        }

        $place = $contest->place;
        return view('contest', compact('contest', 'place'));
    }

    public function attack(Request $request, Contest $contest, $attackType)
    {

        $character = $contest->characters->where('enemy', false)->first();

        if ($character->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }



        if ($contest->win !== null) {
            return redirect()->route('contest.show', $contest->id);
        }

        $attacker = $contest->characters()->first();
        $defender = $contest->characters()->skip(1)->first();

        $damage = $this->calculateDamage($attackType, $attacker, $defender);

        $damage = max(0, $damage);

        $enemyHp = max(0, $defender->pivot->enemy_hp - $damage);

        $defender->pivot->update(['enemy_hp' => $enemyHp]);
        $attacker->pivot->update(['enemy_hp' => $enemyHp]);

        $history = $contest->history ?? '';
        $history .= $attacker->name . ': ' . $attackType . ' attack - ' . $damage . ' damage<br>';
        $contest->update(['history' => $history]);



        if ($enemyHp <= 0) {
            $contest->update(['win' => true]);
            return redirect()->route('contest.show', $contest->id);
        }

        $enemyAttackType = $this->chooseRandomAttackType();

        $enemyDamage = $this->calculateDamage($enemyAttackType, $defender, $attacker);

        $enemyDamage = max(0, $enemyDamage);

        $heroHp = max(0, $attacker->pivot->hero_hp - $enemyDamage);
        $attacker->pivot->update(['hero_hp' => $heroHp]);
        $defender->pivot->update(['hero_hp' => $heroHp]);

        $history = $contest->history ?? '';
        $history .= $defender->name . ': ' . $enemyAttackType . ' attack - ' . $enemyDamage . ' damage<br>';
        $contest->update(['history' => $history]);

        if ($heroHp <= 0) {
            $contest->update(['win' => false]);
            return redirect()->route('contest.show', $contest->id);
        }

        return redirect()->route('contest.show', $contest->id);
    }

    private function calculateDamage($attackType, $attacker, $defender)
    {

        $multipliers = [
            'melee' => ['strength' => 0.7, 'accuracy' => 0.1, 'magic' => 0.1],
            'ranged' => ['strength' => 0.1, 'accuracy' => 0.7, 'magic' => 0.1],
            'special' => ['strength' => 0.1, 'accuracy' => 0.1, 'magic' => 0.7],
        ];

        $damage = $attacker->strength * $multipliers[$attackType]['strength'] +
            $attacker->accuracy * $multipliers[$attackType]['accuracy'] +
            $attacker->magic * $multipliers[$attackType]['magic'] -
            $defender->defence;

        return $damage;
    }

    private function chooseRandomAttackType()
    {

        $attackTypes = ['melee', 'ranged', 'special'];
        return $attackTypes[array_rand($attackTypes)];
    }
}
