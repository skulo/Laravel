@extends('layouts.app')

@section('content')


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contest</title>
        <style>
            body {
                background-image: url('{{ asset('storage/' . $place->image) }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }

            .container {
                color: white;
                padding: 20px;

            }
        </style>
    </head>

    <body>


        <div class="container" style="background-color: rgba(17, 14, 14, 0.8);">
            <h1>Contest in {{ $contest->place->name }}</h1>

            <h2 style="color: blue">{{ $contest->characters[0]->name }}</h2>
            <ul>

                <li>Defence: {{ $contest->characters[0]->defence }}</li>
                <li>Strength: {{ $contest->characters[0]->strength }}</li>
                <li>Accuracy: {{ $contest->characters[0]->accuracy }}</li>
                <li>Magic: {{ $contest->characters[0]->magic }}</li>
                <li>Health: {{ $contest->characters[0]->pivot->hero_hp }}</li>
            </ul>

            <h2 style="color: red">{{ $contest->characters[1]->name }}</h2>
            <ul>
                <li>Defence: {{ $contest->characters[1]->defence }}</li>
                <li>Strength: {{ $contest->characters[1]->strength }}</li>
                <li>Accuracy: {{ $contest->characters[1]->accuracy }}</li>
                <li>Magic: {{ $contest->characters[1]->magic }}</li>
                <li>Health: {{ $contest->characters[1]->pivot->enemy_hp }}</li>
            </ul>

            @if ($contest->win === null && $contest->characters[0]->user_id == auth()->id())
                <h2>Actions</h2>
                <form method="POST"
                    action="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'melee']) }}">
                    @csrf
                    <button type="submit" name="action" value="melee">Melee Attack</button>
                </form>

                <form method="POST"
                    action="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'ranged']) }}">
                    @csrf
                    <button type="submit" name="action" value="ranged">Ranged Attack</button>
                </form>

                <form method="POST"
                    action="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'special']) }}">
                    @csrf
                    <button type="submit" name="action" value="special">Special Attack</button>
                </form>
            @else
                @if ($contest->win)
                    <h2 style="color: rgb(0, 172, 11)">Victory</h2>
                @else
                    @if ($contest->win !== null)
                        <h2 style="color: red">Defeat</h2>
                    @endif
                @endif
            @endif

            <h2>History</h2>
            <div>
                <ul>
                    @foreach (explode('<br>', $contest->history ?? '') as $event)
                        @if (Str::startsWith($event, $contest->characters[0]->name))
                            <li style="color: blue">{{ $event }}</li>
                        @else
                            <li style="color: red">{{ $event }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

    </body>

    </html>

@endsection
