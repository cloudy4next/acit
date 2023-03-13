<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config('backpack.base.html_direction') }}">

<head>
    @include(backpack_view('inc.head'))
    {{-- style="background-image: url('https://i.ibb.co/kD2HLJn/login-bg.jpg')" --}}
    <style>
        body {
            background-image: url('https://i.ibb.co/kD2HLJn/login-bg.jpg');
            background-size: cover;
            background-position: left;
            font-family: Arial, sans-serif;
        }

        .heading-with-image {
            background-image: url('https://i.ibb.co/vqr2r1D/Applogo.png');
            background-repeat: no-repeat;
            background-position: left center;
            padding-left: 50px;
            /* adjust this value to control the spacing between the image and text */
            line-height: 1.5;
            /* adjust this value to vertically center the text */
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
