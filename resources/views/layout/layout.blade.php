<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen|Oxygen+Mono">
    {{--    todo change this css yield to inline or import...--}}
    <link rel="stylesheet" href="assets/css/app.css">
    @yield('css')
</head>
<body>
@include('partials.header')

<div class="container">
    <main>

        <!--MAIN CONTENT -->
    @yield('content')
    <!--MAIN CONTENT -->

    </main>
</div> <!-- wrapper -->

@include('partials.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="assets/js/app.js"></script>
@yield('js')
</body>
</html>
