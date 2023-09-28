<!doctype html>
<html>

<head>

    <link rel="icon" type="image/png"  href="{{ URL::to(env('APP_URL') . '/img/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to(env('APP_URL') . '/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to(env('APP_URL') . '/img/favicon-16x16.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::to(env('APP_URL') . '/css/bootstrap.min.css') }}">
    <script src="{{ URL::to(env('APP_URL') . '/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to(env('APP_URL') . '/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::to(env('APP_URL') . '/css/main.css') }}">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4984866739858484"
        crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1428TJHT3E"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-1428TJHT3E');
    </script>
    @yield('head')

</head>

<body>
    <div class="w-100 navbar-cashcalculator">
        <div class="container">

            <nav class=" row navbar navbar-expand-md  navbar-dark">
                <!-- Brand -->
                <a class="navbar-brand"
                    href="{{ route('home', ['locale' => collect(request()->segments())[0]], true) }}">CashCalculator<span
                        class="text-success h4">.net</span></a>
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    @php
                        $segmentCount = count(request()->segments());
                    @endphp

                    <ul class="navbar-nav ">
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop"
                                data-toggle="dropdown">{{ __('home.language') }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/en/' }}"
                                @else
                                href="{{ env('APP_URL') . '/en/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/US/flat/32.png"> {{ __('English') }} </a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/fr/' }}"
                                @else
                                href="{{ env('APP_URL') . '/fr/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/FR/flat/32.png"> {{ __('French') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/de/' }}"
                                @else
                                href="{{ env('APP_URL') . '/de/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/DE/flat/32.png"> {{ __('German') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/es/' }}"
                                @else
                                href="{{ env('APP_URL') . '/es/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/ES/flat/32.png"> {{ __('Spanish') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/it/' }}"
                                @else
                                href="{{ env('APP_URL') . '/it/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/IT/flat/32.png"> {{ __('Italian') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/ko/' }}"
                                @else
                                href="{{ env('APP_URL') . '/ko/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/KR/flat/32.png"> {{ __('Korean') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/pt-br/' }}"
                                @else
                                href="{{ env('APP_URL') . '/pt-br/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/BR/flat/32.png"> {{ __('Portuguese') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/ru/' }}"
                                @else
                                href="{{ env('APP_URL') . '/ru/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/RU/flat/32.png"> {{ __('Russian') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ env('APP_URL') . '/zh-cn/' }}"
                                @else
                                href="{{ env('APP_URL') . '/zh-cn/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/CN/flat/32.png"> {{ __('Chinese') }}</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('home', ['locale' => collect(request()->segments())[0]], true) }}">{{ __('home.home') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('home.privacypolicy', ['locale' => collect(request()->segments())[0]], true) }}">{{ __('home.privacy_policy_title') }}</a>
                        </li>

                    </ul>

                </div>
            </nav>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="mt-4 navbar-cashcalculator">
        <div class="container ">
            <div class="row text-light py-2 ml-1">
                © 2023 - CashCalculator.net
            </div>
        </div>
    </footer>

    <script src="{{ URL::to(env('APP_URL') . '/js/vue2.js') }}"></script>
    <!-- Custom script -->
    @yield('scripts')

</body>

</html>
