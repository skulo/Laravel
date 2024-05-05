@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Places</title>
    </head>

    <body>

        <div class="container">
            <h1>Places</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($places as $place)
                        <tr>
                            <td>{{ $place->name }}</td>
                            <td><img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name }}"
                                    style="max-width: 100px;">

                            </td>
                            </td>
                            <td>
                                <a href="{{ route('places.edit', $place->id) }}"><button>Edit</button></a>
                                <form action="{{ route('places.destroy', $place->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete it?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('places.create') }}"><button>Create new place</button></a>

        </div>

    </body>

    </html>
@endsection
