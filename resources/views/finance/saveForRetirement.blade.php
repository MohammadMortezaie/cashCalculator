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
            <h1>{{ __('saveForRetirement.seoTitle') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>{{ __('saveForRetirement.introText') }}</p>
                    <p>{{ __('saveForRetirement.seoDescription') }}</p>
                    <p>{{ __('saveForRetirement.future_value_formula') }}</p>

                    <h5 class="h6 alert alert-info">
                        FV = PV × (1 + r)^n
                    </h5>
                    <ul>
                        <li>{{ __('saveForRetirement.fv_description') }}</li>
                        <li>{{ __('saveForRetirement.pv_description') }}</li>
                        <li>{{ __('saveForRetirement.interest_rate_description') }}</li>
                        <li>{{ __('saveForRetirement.years_description') }}</li>
                    </ul>
                    <hr>
                    <p>{{ __('saveForRetirement.monthly_payment_formula') }}</p>
                    <h5 class="h6 alert alert-info">
                        {{ __('saveForRetirement.monthly_payment_equation') }} FV<sub>goal</sub> / ((1 + (r /
                        12))<sup>12n</sup> - 1) / (r / 12)
                    </h5>
                    <ul>
                        <li>{{ __('saveForRetirement.monthly_payment_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_amount_needed_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_interest_rate_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_months_description') }}</li>
                    </ul>
                    <hr>
                    <p>{{ __('saveForRetirement.yearly_payment') }}</p>
                    <h5 class="h6 alert alert-info">
                        {{ __('saveForRetirement.yearly_payment_equation') }} FV<sub>goal</sub> / ((1 + r)<sup>n</sup> - 1)
                        / r
                    </h5>
                    <ul>
                        <li>{{ __('saveForRetirement.yearly_payment_description') }}</li>
                        <li>{{ __('saveForRetirement.yearly_payment_amount_needed_description') }}</li>
                        <li>{{ __('saveForRetirement.yearly_payment_interest_rate_description') }}</li>
                        <li>{{ __('saveForRetirement.yearly_payment_years_description') }}</li>
                    </ul>

                    <!-- ... Rest of your Blade template ... -->

                </section>

                <section class="col-md-12 row">
                    <div class="col-md-6">
                        <h1 class="h3">{{ __('saveForRetirement.calculatorTitle') }}</h1>

                        <label class="h5"
                            for="initialSavings">{{ __('saveForRetirement.initialSavingsLabel') }}</label>
                            <small>@{{ formatNumber(initialSavings) }}</small>  <br>
                        <small>{{ __('saveForRetirement.initialSavingsExplanation') }}</small>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" min="1" class="form-control" v-model="initialSavings">
                        </div>
                        <hr>

                        <label class="h5"
                            for="annualInterestRate">{{ __('saveForRetirement.annualInterestRateLabel') }}</label>
                        <small>@{{ annualInterestRate }}%</small>
                        <br>
                        <small>{{ __('saveForRetirement.annualInterestRateExplanation') }}</small>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" v-model="annualInterestRate">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="h5"
                                for="numberOfYears">{{ __('saveForRetirement.numberOfYearsLabel') }}</label>
                                <small>@{{ numberOfYears }}</small>  <br>
                            <small>{{ __('saveForRetirement.numberOfYearsExplanation') }}</small>
                            <input type="number" min="1" class="form-control" v-model="numberOfYears">
                        </div>
                        <hr>
                        <label class="h5"
                            for="futureValueGoal">{{ __('saveForRetirement.futureValueGoalLabel') }}</label>
                            <small>@{{ formatNumber(futureValueGoal) }}</small> <br>
                        <small>{{ __('saveForRetirement.futureValueGoalExplanation') }}</small>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" min="1" class="form-control" v-model="futureValueGoal">
                        </div>

                        <button class="btn btn-primary"
                            @click="calculateRetirement">{{ __('saveForRetirement.calculateButton') }}</button>

                        <div v-if="futureValue" class="donwload-result ">
                            <hr>
                            <h4 class="bg-success text-white rounded p-2 mt-3">
                                {{ __('saveForRetirement.resultsTitle') }}
                            </h4>
                            <ul class="list-unstyled">

                                <li><strong>{{ __('saveForRetirement.futureValueLabel') }} </strong>
                                    $@{{ formatNumber(futureValue) }}</li>
                                <small>{{ __('saveForRetirement.futureValueExplanation') }}</small>
                                <hr>
                                <li><strong>{{ __('saveForRetirement.monthlyPaymentLabel') }} </strong>
                                    $@{{ formatNumber(monthlyPaymentNeeded) }}</li>
                                <small>{{ __('saveForRetirement.monthlyPaymentExplanation') }}</small>
                                <hr>
                                <li><strong>{{ __('saveForRetirement.yearlyPaymentLabel') }} </strong>
                                    $@{{ formatNumber(yearlyPaymentNeeded) }}</li>
                                <small>{{ __('saveForRetirement.yearlyPaymentExplanation') }}</small>

                            </ul>
                            <form action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                method="GET">
                                <input type="hidden" name="value[0]" value="{{__('saveForRetirement.futureValueLabel')}}">
                                <input type="hidden" name="value[1]" :value="formatNumber(futureValue)">
                                <input type="hidden" name="value[2]" value="{{__('saveForRetirement.monthlyPaymentLabel')}}">
                                <input type="hidden" name="value[3]" :value="formatNumber(monthlyPaymentNeeded)">
                                <input type="hidden" name="value[4]" value="{{__('saveForRetirement.yearlyPaymentLabel')}}">
                                <input type="hidden" name="value[5]" :value="formatNumber(yearlyPaymentNeeded)">
                                <button type="submit" class="btn btn-success my-2">{{ __('BudgetPlanner.DownloadPDF') }}</button>
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
                initialSavings: 10000,
                annualInterestRate: 6,
                numberOfYears: 20,
                futureValueGoal: 1000000,
                futureValue: 0,
                monthlyPaymentNeeded: 0,
                yearlyPaymentNeeded: 0,
            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculateRetirement() {
                    this.annualInterestRateReal = this.annualInterestRate / 100;

                    // Calculate future value
                    this.futureValue = this.initialSavings * Math.pow(1 + this.annualInterestRateReal, this
                        .numberOfYears);

                    // Calculate monthly payment needed (if future value goal is provided)
                    this.monthlyPaymentNeeded = this.futureValueGoal / ((Math.pow(1 + this.annualInterestRateReal /
                        12, this.numberOfYears * 12) - 1) / (this.annualInterestRateReal / 12));

                    this.yearlyPaymentNeeded = this.futureValueGoal / ((Math.pow(1 + this.annualInterestRateReal,
                        this.numberOfYears) - 1) / this.annualInterestRateReal);
                },
            },
        });
    </script>
@endsection
