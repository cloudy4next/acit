<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
    @include(backpack_view('inc.head'))


</head>

<body class="app flex-row align-items-center img-responsive"
    style="background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    max-width: 100%;
    height: auto;

    background-image: url({{ asset('/assets/image/login_bg.png') }});">

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
