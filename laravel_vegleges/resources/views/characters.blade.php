@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Characters</title>
    </head>

    <body>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Defence</th>
                    <th>Strength</th>
                    <th>Accuracy</th>
                    <th>Magic</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $character)
                    <tr>
                        <td style="color: {{ $character->enemy ? 'red' : 'blue' }}">{{ $character->name }}</td>
                        <td>{{ $character->defence }}</td>
                        <td>{{ $character->strength }}</td>
                        <td>{{ $character->accuracy }}</td>
                        <td>{{ $character->magic }}</td>
                        <td><a href="{{ route('characters.show', $character->id) }}"><button>Details</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('characters.create') }}"><button>Create New Character</button></a>
    </body>

    </html>
@endsection
