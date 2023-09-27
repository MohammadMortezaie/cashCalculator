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
    <div id="app">
        <div class="header-content">
            <h1>{{ __('home.h1') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <h3 class="h4">{{ __('home.welcomeMessage') }} </h3>
                    <p> {{ __('home.p1') }}</p>
                    <hr>
                    <div class="row">
                        @php
                            $lang = app()->getLocale();
                        @endphp
                        <div class="col-md-4">
                            <h2 class="h3">{{ __('home.FinancialCalculators') }}</h2>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><a
                                        href="{{ route('home.budgetPlanner', ['locale' => $lang], true) }}">{{ __('home.BudgetPlanner') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.moneyCalculator', ['locale' => $lang], true) }}">{{ __('home.moneyCalculator') }}</a>
                                </li>
                                <li class="list-group-item"><a
                                        href="{{ route('home.503020', ['locale' => $lang], true) }}">{{ __('503020.h1') }}</a>
                                </li>
                                <li class="list-group-item"><a
                                        href="{{ route('home.saveForRetirement', ['locale' => $lang], true) }}">{{ __('compound.h1-RetirementSavings') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.debtPayoff', ['locale' => $lang], true) }}">{{ __('debtPayoff.h1') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.investmentCalculator', ['locale' => $lang], true) }}">{{ __('investmentCalculator.h1') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.compoundInterestCalculator', ['locale' => $lang], true) }}">{{ __('compound.h1') }}</a>
                                </li>

                            </ul>

                        </div>
                        <div class="col-md-4">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item"><a
                                        href="{{ route('home.percentageCalculator', ['locale' => $lang], true) }}">{{ __('percentageCalculator.h1') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.percentDiffCalculator', ['locale' => $lang], true) }}">{{ __('percentDiffCalculator.h1') }}</a>
                                </li>

                                <li class="list-group-item"><a
                                        href="{{ route('home.percentageChangeCalculator', ['locale' => $lang], true) }}">{{ __('percentageChangeCalculator.h1') }}</a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-light ">{{ __('home.topic-1') }}</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('home.desc-1') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-light ">{{ __('home.topic-2') }}</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('home.desc-2') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-light ">{{ __('home.topic-3') }}</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('home.desc-3') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="text-light ">{{ __('home.topic-4') }}</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('home.desc-4') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </section>


            </div>
        </div>
    </div>
@endsection
