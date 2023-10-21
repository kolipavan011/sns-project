<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Vidmin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/sass/app.scss')
</head>

<body class="body">
    <div id="app"></div>
    <script>
        const storynstatus = @json($jsVars);
    </script>
    @vite('resources/js/app.js')
</body>

</html>