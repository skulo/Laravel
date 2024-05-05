@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Character Details</title>
    </head>

    <body>

        <h1>{{ $character->name }} Details</h1>

        <ul>
            <li>Name: {{ $character->name }}</li>
            <li>Defence: {{ $character->defence }}</li>
            <li>Strength: {{ $character->strength }}</li>
            <li>Accuracy: {{ $character->accuracy }}</li>
            <li>Magic: {{ $character->magic }}</li>
        </ul>

        <h2>Matches</h2>
        <ul>
            @foreach ($character->contests as $contest)
                <li>
                    <a href="{{ route('contest.show', $contest->id) }}">
                        {{ $contest->place->name }} -
                        {{ $contest->characters->where('id', '!=', $character->id)->first() ? $contest->characters->where('id', '!=', $character->id)->first()->name : 'N/A' }}


                    </a>
                </li>
            @endforeach
        </ul>


        <a href="{{ route('characters.edit', $character->id) }}"><button>Edit</button></a>

        <form method="POST" action="{{ route('characters.destroy', $character->id) }}"
            onsubmit="return confirm('Are you sure you want to delete this character?')">
            @csrf
            @method('DELETE')

            <button type="submit">Delete Character</button>
        </form>

        @if ($character->enemy === 0)
            <form method="POST" action="{{ route('characters.contest', $character->id) }}">
                @csrf
                <button type="submit">Start New Contest</button>
            </form>
        @endif


    </body>

    </html>
@endsection
