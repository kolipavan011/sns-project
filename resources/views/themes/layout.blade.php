<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! seo($SEOData) !!}
    <link rel="shortcut icon" href="{{ setting()->get('favicon','favicon.ico') }}" type="image/*">
    @vite('resources/sass/theme/theme.scss')

</head>

<body class="body">
    <!-- header -->
    @include('themes.templates.header')
    <!-- Main -->
    <main>
        @yield('hero')
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
    <!-- include js files here -->
    @vite('resources/assets/theme.js')
</body>

</html>