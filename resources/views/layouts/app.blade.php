<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Kanit:400,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:400,700&amp;subset=thai" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        @yield('nav')
        @yield('cms')
        @yield('footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
