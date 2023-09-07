<!doctype html>
<html>

<head>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/favicon-16x16.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

    @yield('head')

</head>

<body>
    <div class="w-100 navbar-cashcalculator">
        <div class="container">

            <nav class=" row navbar navbar-expand-md  navbar-dark">
                <!-- Brand -->
                <a class="navbar-brand" href="/{{ collect(request()->segments())[0] }}">CashCalculator<span
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
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/en/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/en/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/US/flat/32.png"> {{ __('English') }} </a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/fr/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/fr/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/FR/flat/32.png"> {{ __('French') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/de/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/de/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/DE/flat/32.png"> {{ __('German') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/es/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/es/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/ES/flat/32.png"> {{ __('Spanish') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/it/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/it/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/IT/flat/32.png"> {{ __('Italian') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/ko/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/ko/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/KR/flat/32.png"> {{ __('Korean') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/pt-br/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/pt-br/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/BR/flat/32.png"> {{ __('Portuguese') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/ru/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/ru/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/RU/flat/32.png"> {{ __('Russian') }}</a>
                                <a class="dropdown-item"
                                    @if ($segmentCount <= 1) href="{{ request()->getSchemeAndHttpHost() . '/zh-cn/' }}"
                                @else
                                href="{{ request()->getSchemeAndHttpHost() . '/zh-cn/' . collect(request()->segments())->last() }}" @endif>
                                    <img src="https://flagsapi.com/CN/flat/32.png"> {{ __('Chinese') }}</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="/{{ collect(request()->segments())[0] }}">{{ __('home.home') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('home.privacypolicy', ['locale' => collect(request()->segments())[0]]) }}">{{ __('home.privacy_policy_title') }}</a>
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
            <div class="row text-light py-2">
                ©  2023 - CashCalculator.net
            </div>
        </div>
    </footer>

    <script src="{{ URL::asset('js/vue2.js') }}"></script>
    <!-- Custom script -->
    @yield('scripts')

</body>

</html>
