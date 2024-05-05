@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Character</title>
    </head>

    <body>


        <form method="POST" action="{{ route('characters.update', $character->id) }}">
            @csrf
            @method('PATCH')

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $character->name) }}" >
                @error('name')
                <strong>{{ $message }}</strong>
                @enderror
            </div>

            <div>
                <label for="defence">Defence:</label>
                <input type="number" id="defence" name="defence"
                    value="{{ old('defence', $character->defence) }}" >

                    @error('defence')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="strength">Strength:</label>
                <input type="number" id="strength" name="strength" 
                    value="{{ old('strength', $character->strength) }}">
                    @error('strength')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="accuracy">Accuracy:</label>
                <input type="number" id="accuracy" name="accuracy" 
                    value="{{ old('accuracy', $character->accuracy) }}" >
                    @error('accuracy')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>

            <div>
                <label for="magic">Magic:</label>
                <input type="number" id="magic" name="magic" 
                    value="{{ old('magic', $character->magic) }}" >
                    @error('magic')
                    <strong>{{ $message }}</strong>
                    @enderror
            </div>



            <input type="hidden" id="enemy" name="enemy" value="{{ $character->enemy }}">

            <button type="submit">Update Character</button>

            @error('error')
                <div>{{ $message }}</div>
            @enderror
        </form>



    </body>

    </html>
@endsection
