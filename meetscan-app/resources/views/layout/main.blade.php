<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layout.partials.head')
    <style>
        .tableContent {
            margin: 1rem;
        }

        .btnActions {
            margin-top: 1rem;
        }
    </style>
    @yield('styles')
    <title>@yield('title')</title>
</head>
<body>
    @include('layout.partials.menu')
    @yield('content')
    @include('layout.partials.footer')
</body>
</html>