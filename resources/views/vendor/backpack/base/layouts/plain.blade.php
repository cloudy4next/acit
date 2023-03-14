<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
    @include(backpack_view('inc.head'))
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-image: url('https://i.ibb.co/kD2HLJn/login-bg.jpg');
            background-size: cover;
            background-position: left;
            font-family: Arial, sans-serif;
        }
    </style>

</head>

<body class="app flex-row align-items-center">

    @yield('header')

    <div class="container">
        @yield('content')
    </div>

    <footer class="app-footer sticky-footer">
        @include('backpack::inc.footer')
    </footer>

    @yield('before_scripts')
    @stack('before_scripts')

    @include(backpack_view('inc.scripts'))

    @yield('after_scripts')
    @stack('after_scripts')

</body>

</html>
