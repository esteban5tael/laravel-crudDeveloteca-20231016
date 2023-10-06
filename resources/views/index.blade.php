<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">

    <!-- Optional: You can include your custom CSS file here -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/index.blade.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">{{ __('Employees') }}</a>
            
            <div class="navbar" >
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Include your main content here -->
    @include('layouts._partials.menuppal')

    <!-- Optional: You can include your custom JavaScript file here -->
    <script src="{{ asset('storage/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
