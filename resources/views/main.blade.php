<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <title>sadasds</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">

    <!-- Custom Styles -->
    @yield('styles')

</head>

<body>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="{{URL::asset('js/vue2.js')}}"></script>
    <!-- Custom script -->
    @yield('scripts')

</body>

</html>
