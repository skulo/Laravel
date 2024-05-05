@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to the Game</title>
    </head>

    <body>
        <h1>Game Description</h1>

        <p>This is a game, where you can create your own characters, and start contests with enemies at different places.
        </p>

        <h2>Statistics</h2>
        <ul>
            <li>Total number of characters: {{ $totalCharacters }}</li>
            <li>Total number of contests: {{ $totalContests }}</li>


        </ul>
    </body>

    </html>
@endsection
