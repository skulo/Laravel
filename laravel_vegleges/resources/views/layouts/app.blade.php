<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight Game</title>
    <style>
        nav {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        body {
            background-color: #ccc;

        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Main Menu</a></li>
            @auth
                @if (auth()->user()->admin)
                    <li><a href="{{ route('places.index') }}">Places</a></li>
                @endif
            @endauth


            @if (Route::has('login'))
                @auth
                    <li><a href="{{ route('characters.index') }}">Characters</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"
                            class="text-sm text-gray-700 underline">Log out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    </li>

                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>

                        </li>
                    @endif
                @endauth

            @endif
        </ul>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>
