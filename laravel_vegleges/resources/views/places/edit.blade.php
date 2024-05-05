@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit place</title>
    </head>

    <body>

        <div class="container">
            <div>
                <div>
                    <div>
                        <div>{{ 'Edit place' }}</div>

                        <div>
                            <form method="POST" action="{{ route('places.update', $place->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="name">{{ ('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $place->name) }}" autofocus>

                                    @error('name')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div>
                                    <label for="image">{{ ('Image') }}</label>
                                    <input id="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        accept="image/*">

                                    @error('image')
                                        <span>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit">
                                        {{ ('Save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>
@endsection
