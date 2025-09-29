<!doctype html>
<html>

<head>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to(env('APP_URL') . '/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to(env('APP_URL') . '/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to(env('APP_URL') . '/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::to(env('APP_URL') . '/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ URL::to(env('APP_URL') . '/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

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

    <link rel="canonical" href="{{ URL::current() }}">
</head>

<body>

    <div class=" cc-navbar w-100 navbar-cashcalculator">
        <div class="container ">
            @php
                $segments = request()->segments();
                $locale = $segments[0] ?? 'en';
                // Rebuild remainder of the path after the locale to preserve deep paths
                $remainder = implode('/', array_slice($segments, 1));

                // Locale label + flag map
                $locales = [
                    'en' => ['label' => __('home.English'), 'flag' => 'US'],
                    'fr' => ['label' => __('home.French'), 'flag' => 'FR'],
                    'de' => ['label' => __('home.German'), 'flag' => 'DE'],
                    'es' => ['label' => __('home.Spanish'), 'flag' => 'ES'],
                    'it' => ['label' => __('home.Italian'), 'flag' => 'IT'],
                    'ko' => ['label' => __('home.Korean'), 'flag' => 'KR'],
                    'pt-br' => ['label' => __('home.Portuguese'), 'flag' => 'BR'],
                    'ru' => ['label' => __('home.Russian'), 'flag' => 'RU'],
                    'zh-cn' => ['label' => __('home.Chinese'), 'flag' => 'CN'],
                ];

                // Helper to build localized URLs preserving the remainder of the path
                $localizedUrl = function (string $code) use ($remainder) {
                    $base = rtrim(env('APP_URL'), '/');
                    return $remainder ? "{$base}/{$code}/{$remainder}" : "{$base}/{$code}";
                };
            @endphp

            <nav class="row navbar navbar-expand-md navbar-dark  px-3">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center gap-2"
                    href="{{ route('home', ['locale' => $locale], true) }}">
                    <span class="cc-logo">CashCalculator</span><span class="cc-dot">.net</span>
                </a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ccNav"
                    aria-controls="ccNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="collapse navbar-collapse" id="ccNav">
                    <ul class="navbar-nav mr-auto"></ul>

                    <ul class="navbar-nav align-items-md-center">
                        <!-- Language dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="langDrop"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="cc-flag mr-2"
                                    src="https://flagsapi.com/{{ $locales[$locale]['flag'] ?? 'US' }}/flat/24.png"
                                    alt="">
                                <span class="d-none d-sm-inline">{{ __('home.language') }}</span>
                                <span class="d-inline d-sm-none">{{ strtoupper($locale) }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="langDrop">
                                @foreach ($locales as $code => $meta)
                                    <a class="dropdown-item d-flex align-items-center {{ $code === $locale ? 'active' : '' }}"
                                        href="{{ $localizedUrl($code) }}"
                                        @if ($code === $locale) aria-current="true" @endif>
                                        <img class="cc-flag mr-2"
                                            src="https://flagsapi.com/{{ $meta['flag'] }}/flat/24.png" alt="">
                                        <span>{{ $meta['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </li>

                        <!-- Primary links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home', ['locale' => $locale], true) }}">{{ __('home.home') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home.privacypolicy') ? 'active' : '' }}"
                                href="{{ route('home.privacypolicy', ['locale' => $locale], true) }}">{{ __('home.privacy_policy_title') }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="mt-4 cc-navbar navbar-cashcalculator">
        <div class="container ">
            <div class="row text-light py-2 ml-1">
                © 2023 - CashCalculator.net <a class="pl-2 fw-bold" href="https://webpulse.ca/"> Webpulse </a>
            </div>
        </div>
    </footer>

    <script src="{{ URL::to(env('APP_URL') . '/js/vue2.js') }}"></script>
    <!-- Custom script -->
    @yield('scripts')

</body>

</html>
