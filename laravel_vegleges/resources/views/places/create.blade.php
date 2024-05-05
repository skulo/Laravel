@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create place</title>
    </head>

    <body>


        <div class="container">
            <h1>Create a new place</h1>
            <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label for="image">Upload image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <button type="submit">Create place</button>
            </form>
        </div>


    </body>

    </html>
@endsection
