<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <div class="col-12 my-3">
                    <div class="card">
                        <div class="card-body text-center py-5 my-5">
                            <h1 class="card-title mb-4">Page Not Found ..!</h1>
                            <p class="card-text">Oops! Something is wrong</p>
                            <a href="/" class="btn btn-primary">Go Homepage</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
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