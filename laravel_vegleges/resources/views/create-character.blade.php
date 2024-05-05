@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Your Character</title>
    </head>

    <body>


        <h1>Create New Character</h1>

        <form method="POST" action="{{ route('characters.store') }}">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                <strong>{{ $message }}</strong>
                @enderror
            </div>

            <div>
                <label for="defence">Defence:</label>
                <input type="number" id="defence" name="defence" 
                    value="{{ old('defence') }}">

                    @error('defence')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="strength">Strength:</label>
                <input type="number" id="strength" name="strength" 
                    value="{{ old('strength') }}">

                    @error('strength')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="accuracy">Accuracy:</label>
                <input type="number" id="accuracy" name="accuracy" 
                    value="{{ old('accuracy') }}">

                    @error('accuracy')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="magic">Magic:</label>
                <input type="number" id="magic" name="magic" 
                    value="{{ old('magic') }}">

                    @error('magic')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            @if (auth()->user()->admin)
                <div>
                    <label for="enemy">Enemy:</label>
                    <input type="number" id="enemy" name="enemy" value="1">
                    @error('enemy')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            @else
                <input type="hidden" id="enemy" name="enemy" value="0">
            @endif

            <input type="hidden" id="user_id" name="user_id" value="0">

            <button type="submit">Create Character</button>

            @error('error')
                <div>{{ $message }}</div>
            @enderror

        </form>


    </body>

    </html>
@endsection
