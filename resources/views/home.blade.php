@extends('main')

@section('head')
    <?php
    $seotools = app('seotools');
    $metatags = app('seotools.metatags');
    $twitter = app('seotools.twitter');
    $opengraph = app('seotools.opengraph');
    $jsonld = app('seotools.json-ld');
    $jsonldMulti = app('seotools.json-ld-multi');

    echo app('seotools')->generate();
    ?>
@endsection



@section('content')
    @php
        $lang = app()->getLocale();

        $financial = [
            [
                'title' => __('home.moneyCalculator'),
                'desc' => __('home.desc_moneycalculator'),
                'route' => route('home.moneyCalculator', ['locale' => $lang], true),
                'popular' => true,
            ],
            [
                'title' => __('home.BudgetPlanner'),
                'desc' => __('home.desc_budgetplanner'),
                'route' => route('home.budgetPlanner', ['locale' => $lang], true),
            ],
            [
                'title' => __('503020.h1'),
                'desc' => __('home.desc_503020'),
                'route' => route('home.503020', ['locale' => $lang], true),
            ],
            [
                'title' => __('compound.h1-RetirementSavings'),
                'desc' => __('home.desc_retirement'),
                'route' => route('home.saveForRetirement', ['locale' => $lang], true),
            ],
            [
                'title' => __('debtPayoff.h1'),
                'desc' => __('home.desc_debtpayoff'),
                'route' => route('home.debtPayoff', ['locale' => $lang], true),
            ],
            [
                'title' => __('investmentCalculator.h1'),
                'desc' => __('home.desc_investment'),
                'route' => route('home.investmentCalculator', ['locale' => $lang], true),
            ],
            [
                'title' => __('compound.h1'),
                'desc' => __('home.desc_compound'),
                'route' => route('home.compoundInterestCalculator', ['locale' => $lang], true),
            ],
        ];

        $math = [
            [
                'title' => __('percentageCalculator.h1'),
                'desc' => __('home.desc_percentage'),
                'route' => route('home.percentageCalculator', ['locale' => $lang], true),
            ],
            [
                'title' => __('percentDiffCalculator.h1'),
                'desc' => __('home.desc_percentdiff'),
                'route' => route('home.percentDiffCalculator', ['locale' => $lang], true),
            ],
            [
                'title' => __('percentageChangeCalculator.h1'),
                'desc' => __('home.desc_percentagechange'),
                'route' => route('home.percentageChangeCalculator', ['locale' => $lang], true),
            ],
            [
                'title' => __('home.calculator'),
                'desc' => __('home.desc_basiccalc'),
                'route' => route('home.calculator', ['locale' => $lang], true),
            ],
        ];

        $health = [
            [
                'title' => __('bmi.h1'),
                'desc' => __('home.desc_bmi'),
                'route' => route('home.bmi', ['locale' => $lang], true),
            ],
        ];

        $localeMap = [
            'en' => __('home.English'),
            'fr' => __('home.French'),
            'de' => __('home.German'),
            'es' => __('home.Spanish'),
            'it' => __('home.Italian'),
            'ko' => __('home.Korean'),
            'pt-br' => __('home.Portuguese'),
            'ru' => __('home.Russian'),
            'zh-cn' => __('home.Chinese'),
        ];
    @endphp

    <div id="app">

        {{-- HERO --}}
        <section class="hero hero-padding py-5">
            <div class="container wrap">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span
                            class="badge text-bg-primary-subtle border border-primary-subtle rounded-pill fw-semibold px-3 py-2">
                            {{ __('home.kicker') }}
                        </span>
                        <h1 class="fw-bold mt-3 mb-2 text-ink">{{ __('home.h1') }}</h1>
                        <p class="lead text-muted-cc mb-4">{{ __('home.welcomeMessage') }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <a class="btn btn-brand btn-pill btn-xl mr-2 mb-2"
                                href="{{ route('home.moneyCalculator', ['locale' => $lang], true) }}">
                                {{ __('home.cta_primary') }}
                            </a>
                            <a href="#all-calculators" class="btn btn-outline-ink btn-pill btn-xl mr-2 mb-2">
                                {{ __('home.cta_secondary') }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-3">
                            <span
                                class="badge text-bg-success-subtle border border-success-subtle rounded-pill fw-semibold px-3 py-2 mr-2">{{ strtoupper($lang) }}</span>
                            <small class="text-muted-cc">{{ __('home.lang_note') }}</small>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="hero-card p-3 p-md-4">
                            <svg viewBox="0 0 600 340" class="w-100 h-auto" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Financial growth illustration">
                                <rect x="30" y="30" width="540" height="280" rx="14" fill="#ffffff"
                                    stroke="#e8eef6" />
                                <rect x="90" y="220" width="36" height="60" rx="6" fill="#198754" />
                                <rect x="150" y="190" width="36" height="90" rx="6" fill="#0d47a1" />
                                <rect x="210" y="170" width="36" height="110" rx="6" fill="#198754" />
                                <rect x="270" y="130" width="36" height="150" rx="6" fill="#0d47a1" />
                                <rect x="330" y="110" width="36" height="170" rx="6" fill="#198754" />
                                <rect x="390" y="90" width="36" height="190" rx="6" fill="#0d47a1" />
                                <circle cx="470" cy="265" r="8" fill="#198754" /><text x="485" y="269"
                                    font-size="12" fill="#6c757d">$$</text>
                                <circle cx="470" cy="287" r="8" fill="#0d47a1" /><text x="485" y="291"
                                    font-size="12" fill="#6c757d">++</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SPOTLIGHT + TRENDING --}}
        <section class="py-5" style="background:var(--bg);">
            <div class="container wrap">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card cc-card spotlight">
                            <div
                                class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">

                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h2 class="h4 mb-0 text-ink">{{ __('home.moneyCalculator') }}</h2>
                                        <span class="popular-badge ml-2">{{ __('home.popular') }}</span>
                                    </div>
                                    <p class="text-muted-cc mb-3">{{ __('home.desc_moneycalculator') }}</p>
                                    <a class="btn btn-dark-cc btn-pill"
                                        href="{{ route('home.moneyCalculator', ['locale' => $lang], true) }}">
                                        {{ __('home.cta_primary') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card cc-card h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-3 text-ink">{{ __('home.top_tools') }}</h3>
                                <div class="d-grid gap-2">
                                    <a class="btn btn-soft btn-pill text-start"
                                        href="{{ route('home.budgetPlanner', ['locale' => $lang], true) }}">{{ __('home.BudgetPlanner') }}</a>
                                    <a class="btn btn-soft btn-pill text-start"
                                        href="{{ route('home.compoundInterestCalculator', ['locale' => $lang], true) }}">{{ __('compound.h1') }}</a>
                                    <a class="btn btn-soft btn-pill text-start"
                                        href="{{ route('home.percentageCalculator', ['locale' => $lang], true) }}">{{ __('percentageCalculator.h1') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ALL CALCULATORS --}}
        <section id="all-calculators" class="py-5">
            <div class="container wrap">
                <h2 class="section-title text-center mb-2">{{ __('home.FinancialCalculators') }}</h2>
                <p class="text-center text-muted-cc mb-4">{{ __('home.p1') }}</p>

                <div class="row g-4">
                    @foreach ($financial as $item)
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <div class="card cc-card {{ !empty($item['popular']) ? 'spotlight' : '' }}">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between">
                                        <h5 class="title mb-1">{{ $item['title'] }}</h5>
                                        @if (!empty($item['popular']))
                                            <span class="popular-badge ms-2">{{ __('home.popular') }}</span>
                                        @endif
                                    </div>
                                    <p class="desc mb-3">{{ $item['desc'] }}</p>
                                    <a href="{{ $item['route'] }}" class="btn btn-outline-ink btn-pill btn-sm">
                                        {{ __('home.open_tool') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="divider my-5"></div>

                <h3 class="h4 mb-3 text-ink">{{ __('home.MathCalculators') }}</h3>
                <div class="row g-4">
                    @foreach ($math as $item)
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <div class="card cc-card">
                                <div class="card-body">
                                    <h6 class="title mb-1">{{ $item['title'] }}</h6>
                                    <p class="desc mb-3">{{ $item['desc'] }}</p>
                                    <a href="{{ $item['route'] }}"
                                        class="btn btn-outline-ink btn-pill btn-sm">{{ __('home.open_tool') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="divider my-5"></div>

                <h3 class="h4 mb-3 text-ink">{{ __('bmi.FH') }}</h3>
                <div class="row g-4">
                    @foreach ($health as $item)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card cc-card">
                                <div class="card-body">
                                    <h5 class="title mb-1">{{ $item['title'] }}</h5>
                                    <p class="desc mb-3">{{ $item['desc'] }}</p>
                                    <a href="{{ $item['route'] }}"
                                        class="btn btn-outline-ink btn-pill btn-sm">{{ __('home.open_tool') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- CTA --}}
        <section class="py-5" style="background:var(--bg);">
            <div class="container wrap">
                <div class="p-4 p-lg-5 bg-white border rounded-4 d-lg-flex justify-content-between align-items-center"
                    style="box-shadow:var(--shadow);">
                    <div class="mb-3 mb-lg-0">
                        <h3 class="fw-bold mb-1 text-ink">{{ __('home.cta_headline') }}</h3>
                        <p class="text-muted-cc mb-0">{{ __('home.cta_sub') }}</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a class="btn btn-dark-cc btn-pill btn-xl mr-2"
                            href="{{ route('home.moneyCalculator', ['locale' => $lang], true) }}">{{ __('home.cta_primary') }}</a>
                        <a class="btn btn-outline-ink btn-pill btn-xl"
                            href="#all-calculators">{{ __('home.cta_secondary') }}</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- LANGUAGE BUTTON BAR --}}
        <section class="py-4">
            <div class="container wrap">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    @foreach ($localeMap as $code => $label)
                        <a href="{{ route('home', ['locale' => $code], true) }}"
                            class="lang-btn mx-1 my-1 @if ($code === $lang) active @endif"
                            @if ($code === $lang) aria-current="true" @endif>
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
