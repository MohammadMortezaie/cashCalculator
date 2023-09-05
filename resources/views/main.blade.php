<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

    @yield('head')

</head>

<body>

    <nav class="navbar navbar-expand-md  navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">CashCalculator.net</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
            </ul>

            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Language
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="{{  URL::current(['locale' => 'en'])  }}">French</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    <script src="{{ URL::asset('js/vue2.js') }}"></script>
    <!-- Custom script -->
    @yield('scripts')

</body>

</html>
