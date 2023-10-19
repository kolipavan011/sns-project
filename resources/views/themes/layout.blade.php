<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Vidmin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/sass/theme/theme.scss')

</head>

<body class="body">
    <!-- header -->
    @include('themes.templates.header')
    <!-- Main -->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 my-3">
                    @yield('content')
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 ps-lg-5 my-3">
                    @include('themes.templates.sidebar')
                </div>
            </div>
        </div>
    </main>
    <!-- footer -->
    @include('themes.templates.footer')
</body>

</html>