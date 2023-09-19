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
            <h1>{{ __('investmentCalculator.investment_calculator_title') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>{{ __('investmentCalculator.investment_calculator_description') }}</p>
                    <ul>
                        <li>{{ __('investmentCalculator.initial_investment_explanation') }}</li>
                        <li>{{ __('investmentCalculator.start_year_explanation') }}</li>
                        <li>{{ __('investmentCalculator.end_year_explanation') }}</li>
                        <li>{{ __('investmentCalculator.annual_interest_rate_explanation') }}</li>
                        <li>{{ __('investmentCalculator.annual_inflation_rate_explanation') }}</li>
                    </ul>

                    <h4>{{ __('investmentCalculator.inflation_effect_title') }}</h4>
                    <h5 class="h6 alert alert-info">
                        {{ __('investmentCalculator.inflation_effect_formula') }}
                    </h5>

                    <h4>{{ __('investmentCalculator.total_interest_earned_title') }}</h4>
                    <h5 class="h6 alert alert-info">
                        {{ __('investmentCalculator.total_interest_earned_formula') }}
                    </h5>

                    <h4>{{ __('investmentCalculator.interest_earned_after_inflation_title') }}</h4>
                    <h5 class="h6 alert alert-info">
                        {{ __('investmentCalculator.interest_earned_after_inflation_formula') }}
                    </h5>

                    <h4>{{ __('investmentCalculator.total_future_value_title') }}</h4>
                    <h5 class="h6 alert alert-info">
                        {{ __('investmentCalculator.total_future_value_formula') }}
                    </h5>
                    <hr>
                </section>

                <section class="col-md-12">
                    <div class="col-md-6">
                        <!-- Investment input form -->
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <label>{{ __('investmentCalculator.initial_investment_label') }}</label>
                                <small>$@{{ formatNumber(initialInvestment) }}</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="initialInvestment">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>{{ __('investmentCalculator.start_year_label') }}</label>
                                <small>@{{ startYear }}</small>
                                <div class="input-group">
                                    <input type="number" class="form-control" v-model="startYear">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>{{ __('investmentCalculator.end_year_label') }}</label>
                                <small>@{{ endYear }}</small>
                                <div class="input-group">
                                    <input type="number" class="form-control" v-model="endYear">
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label>{{ __('investmentCalculator.annual_interest_rate_label') }}</label>
                                    <small>@{{ annualInterestRate }}%</small>
                                    <div class="input-group">
                                        <input type="number" class="form-control" v-model="annualInterestRate">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label>{{ __('investmentCalculator.annual_inflation_rate_label') }}</label>
                                    <small>@{{ annualInflationRate }}%</small>
                                    <div class="input-group">
                                        <input type="number" class="form-control" v-model="annualInflationRate">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <button class="btn btn-primary"
                                    @click="calculate">{{ __('investmentCalculator.calculate_button') }}</button>
                            </div>

                        </div>

                        <!-- Investment results -->
                        <div class="mt-4 " v-if="futureValue != 0">
                            <h2>{{ __('investmentCalculator.results_title') }}</h2>
                            <p>{{ __('investmentCalculator.inflation_effect_result') }}: @{{ formatNumber(inflationEffect) }}</p>
                            <p>{{ __('investmentCalculator.total_interest_earned_result') }}: @{{ formatNumber(totalInterestEarned) }}</p>
                            <p>{{ __('investmentCalculator.interest_earned_after_inflation_result') }}:
                                @{{ formatNumber(interestAfterInflation) }}</p>
                            <p>{{ __('investmentCalculator.total_future_value_result') }}: @{{ formatNumber(futureValue) }}</p>

                            <form
                                action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                method="GET">
                                <input type="hidden" name="value[0]" value="{{__('investmentCalculator.results_title')}}">
                                <input type="hidden" name="value[1]" value="{{__('investmentCalculator.inflation_effect_result')}}">
                                <input type="hidden" name="value[2]" :value="formatNumber(inflationEffect)">
                                <input type="hidden" name="value[3]" value="{{__('investmentCalculator.total_interest_earned_result')}}">
                                <input type="hidden" name="value[4]" :value="formatNumber(totalInterestEarned)">
                                <input type="hidden" name="value[5]" value="{{__('investmentCalculator.interest_earned_after_inflation_result')}}">
                                <input type="hidden" name="value[6]" :value="formatNumber(interestAfterInflation)">
                                <input type="hidden" name="value[7]" value="{{__('investmentCalculator.total_future_value_result')}}">
                                <input type="hidden" name="value[8]" :value="formatNumber(futureValue)">
                                <button type="submit"
                                    class="btn btn-success my-2">{{ __('investmentCalculator.download_pdf_button') }}</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: "#app",
            data: {
                initialInvestment: 100000,
                startYear: 2023,
                endYear: 2043,
                annualInterestRate: 6,
                annualInflationRate: 2,
                inflationEffect: 0,
                totalInterestEarned: 0,
                interestAfterInflation: 0,
                futureValue: 0,
            },

            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculate() {
                    // Perform calculations and update data properties
                    this.inflationEffect = this.calculateInflationEffect();
                    this.totalInterestEarned = this.calculateTotalInterestEarned();
                    this.interestAfterInflation = this.calculateInterestAfterInflation();
                    this.futureValue = this.calculateFutureValue();
                },
                calculateInflationEffect() {
                    const years = Number(this.endYear) - Number(this.startYear) + 1;
                    const initialInvestment = parseFloat(this.initialInvestment);
                    const annualInflationRate = parseFloat(this.annualInflationRate) / 100;
                    return (Number(initialInvestment) * (Math.pow(1 + annualInflationRate, years) - 1)).toFixed(2);
                },
                calculateTotalInterestEarned() {
                    const years = Number(this.endYear) - Number(this.startYear) + 1;
                    const initialInvestment = parseFloat(this.initialInvestment);
                    const annualInterestRate = parseFloat(this.annualInterestRate) / 100;
                    return (Number(initialInvestment) * (Math.pow(1 + annualInterestRate, years) - 1)).toFixed(2);
                },
                calculateInterestAfterInflation() {
                    const inflationEffect = parseFloat(this.inflationEffect);
                    const totalInterestEarned = parseFloat(this.totalInterestEarned);
                    return (Number(totalInterestEarned) - inflationEffect).toFixed(2);
                },
                calculateFutureValue() {
                    const years = Number(this.endYear) - Number(this.startYear) + 1;
                    const initialInvestment = parseFloat(this.initialInvestment);
                    const annualInterestRate = parseFloat(this.annualInterestRate) / 100;
                    return (Number(initialInvestment) * Math.pow(1 + annualInterestRate, years)).toFixed(2);
                },
            },

        });
    </script>
@endsection
