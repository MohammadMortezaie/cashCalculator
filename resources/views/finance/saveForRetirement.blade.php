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
            <h1> {{ __('saveForRetirement.seoTitle') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>{{ __('saveForRetirement.future_value_formula') }}</p>
                    <h5 class="h6 alert alert-info">
                        {{ __('saveForRetirement.future_value_equation') }}
                    </h5>

                    <ul>
                        <li>{{ __('saveForRetirement.fv_description') }}</li>
                        <li>{{ __('saveForRetirement.pv_description') }}</li>
                        <li>{{ __('saveForRetirement.interest_rate_description') }}</li>
                        <li>{{ __('saveForRetirement.years_description') }}</li>
                    </ul>

                    <p>{{ __('saveForRetirement.amount_needed') }}</p>

                    <p>{{ __('saveForRetirement.monthly_payment_formula') }}</p>
                    <h5 class="h6 alert alert-info">
                        {{ __('saveForRetirement.monthly_payment_equation') }}
                    </h5>
                    <ul>
                        <li>{{ __('saveForRetirement.monthly_payment_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_amount_needed_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_interest_rate_description') }}</li>
                        <li>{{ __('saveForRetirement.monthly_payment_months_description') }}</li>
                    </ul>

                    <p>{{ __('saveForRetirement.yearly_payment') }}</p>
                    <h5 class="h6 alert alert-info">
                        {{ __('saveForRetirement.yearly_payment_equation') }}
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
                        <tr>
                            <td>{{ __('saveForRetirement.your_age_now') }}</td>
                            <td>
                                <input type="number" v-model="ageNow" class="form-control mb-3">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('saveForRetirement.your_planned_retirement_age') }}</td>
                            <td>
                                <input type="number" v-model="retireAge" class="form-control mb-3">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('saveForRetirement.amount_needed_at_retirement_age') }}</td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" v-model="neededAmount" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('saveForRetirement.your_retirement_savings_now') }}</td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="savingNow">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('saveForRetirement.average_investment_return') }}</td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" v-model="invReturn">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 10px;">
                                <button class="btn btn-primary"
                                    @click="calculateRetirement">{{ __('saveForRetirement.calculate_button') }}</button>
                                <input class="btn btn-danger" type="button"
                                    value="{{ __('saveForRetirement.clear_button') }}" @Click="clearForm">
                            </td>
                        </tr>

                        <div v-if="results" class="mt-3">
                            <h3>{{ __('saveForRetirement.results') }}</h3>

                            <!-- Monthly Savings Plan -->
                            <div class="result-card">
                                <h4 class="bg-success text-white rounded p-2">
                                    {{ __('saveForRetirement.monthly_savings_plan') }}
                                </h4>
                                <ul class="list-unstyled">
                                    <li><strong>{{ __('saveForRetirement.amount_to_save_monthly') }}</strong>
                                        $@{{ results[0].amount }}</li>
                                    <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                                        $@{{ results[0].principal }}</li>
                                    <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                                        $@{{ results[0].interest }}</li>
                                </ul>
                            </div>
                            <hr>
                            <!-- Yearly Savings Plan -->
                            <div class="result-card">
                                <h4 class="bg-success text-white rounded p-2">
                                    {{ __('saveForRetirement.yearly_savings_plan') }}</h4>
                                <ul class="list-unstyled">
                                    <li><strong>{{ __('saveForRetirement.amount_to_save_yearly') }}</strong>
                                        $@{{ results[1].amount }}
                                    </li>
                                    <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                                        $@{{ results[1].principal }}</li>
                                    <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                                        $@{{ results[1].interest }}</li>
                                </ul>
                            </div>
                            <hr>
                            <!-- Lump Sum Savings Plan -->
                            <div class="result-card">
                                <h4 class="bg-success text-white rounded p-2">
                                    {{ __('saveForRetirement.lump_sum_savings_plan') }}
                                </h4>
                                <ul class="list-unstyled">
                                    <li><strong>{{ __('saveForRetirement.additional_amount_needed') }}</strong>
                                        $@{{ results[2].amount }}</li>
                                    <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                                        $@{{ results[2].principal }}</li>
                                    <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                                        $@{{ results[2].interest }}</li>
                                </ul>
                                <form v-if="results"
                                    action="{{ route('pdf.saveForRetirement', ['locale' => collect(request()->segments())[0]], true) }}"
                                    method="GET">
                                    <input type="hidden" name="results" :value="JSON.stringify(results)">
                                    <button type="submit"
                                        class="btn btn-success my-2">{{ __('BudgetPlanner.DownloadPDF') }}</button>
                                </form>
                            </div>
                        </div>

                    </div>
            </div>


        </div>

    </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: "#app",
            data: {
                ageNow: 35,
                retireAge: 67,
                neededAmount: 600000,
                savingNow: 30000,
                invReturn: 6,
                results: null,
            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculateRetirement() {

                    const yearsToSave = this.retireAge - this.ageNow;

                    // Calculate the future value of current savings
                    const futureValue = this.savingNow * Math.pow(1 + this.invReturn / 100, yearsToSave);

                    // Calculate the amount needed to reach the desired savings goal
                    const amountNeeded = this.neededAmount - futureValue;

                    // Calculate monthly savings plan
                    const monthlyInterestRate = this.invReturn / 100 / 12;
                    const months = yearsToSave * 12;
                    const monthlyPayment = amountNeeded * (monthlyInterestRate / (1 - Math.pow(1 +
                        monthlyInterestRate, -months)));
                    const monthlyPrincipal = monthlyPayment * months - amountNeeded;
                    const monthlyInterest = futureValue - monthlyPrincipal;

                    // Calculate yearly savings plan
                    const yearlyInterestRate = this.invReturn / 100;
                    const yearlyPayment = amountNeeded / ((Math.pow(1 + yearlyInterestRate, yearsToSave) - 1) / (
                        yearlyInterestRate * Math.pow(1 + yearlyInterestRate, yearsToSave)));
                    const yearlyPrincipal = yearlyPayment * yearsToSave;
                    const yearlyInterest = futureValue - yearlyPrincipal;

                    // Calculate lump sum savings plan
                    const lumpSumPrincipal = amountNeeded;
                    const lumpSumInterest = futureValue - lumpSumPrincipal;


                    this.results = [{
                            amount: this.formatNumber(monthlyPayment),
                            principal: this.formatNumber(monthlyPrincipal),
                            interest: this.formatNumber(monthlyInterest),
                        },
                        {
                            amount: this.formatNumber(yearlyPayment),
                            principal: this.formatNumber(yearlyPrincipal),
                            interest: this.formatNumber(yearlyInterest),
                        },
                        {
                            amount: this.formatNumber(amountNeeded),
                            principal: this.formatNumber(lumpSumPrincipal),
                            interest: this.formatNumber(lumpSumInterest),
                        },
                    ];
                },
                clearForm() {
                    this.ageNow = '';
                    this.retireAge = '';
                    this.neededAmount = '';
                    this.savingNow = '';
                    this.invReturn = '';
                    this.results = null;
                },

            },
        });
    </script>
@endsection
