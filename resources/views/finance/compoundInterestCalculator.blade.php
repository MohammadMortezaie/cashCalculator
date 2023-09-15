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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    <div id="app">
        <div class="header-content">
            <h1>{{ __('compound.calculator_title') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>{{ __('compound.seoDescription') }}</p>
                    <p>{{ __('compound.introduction') }}</p>
                    <p>{{ __('compound.what_is_compound_interest') }}</p>
                    <hr>
                    <h4>{{ __('compound.understanding_calculator') }}</h4>


                    <h3 class="h5">{{ __('compound.input_variables') }}</h3>
                    <ul>
                        <li>{{ __('compound.principal_description') }}</li>
                        <li>{{ __('compound.annual_interest_rate_description') }}</li>
                        <li>{{ __('compound.compounding_frequency_description') }}</li>
                        <li>{{ __('compound.number_of_years_description') }}</li>
                    </ul>
                    <h5 class="h6 alert alert-info">
                        {{ __('compound.formula') }}
                    </h5>
                    <hr>
                    <h3 class="h5">{{ __('compound.calculations') }}</h3>
                    <ul>
                        <li>{{ __('compound.calculations_description') }}</li>
                        <li>{{ __('compound.calculation_performed') }}</li>
                    </ul>


                </section>
                <section class="col-md-12">
                    <hr>
                    <div class="col-md-6">
                        <h3>{{ __('compound.calculator_heading') }}</h3>
                        <div class="form-group3">
                            <label>{{ __('compound.principal_label') }}:</label>
                            <small>$@{{ formatNumber(principal) }}</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" v-model="principal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('compound.annual_interest_rate_label') }}:</label>
                            <small>@{{ interestRate }}%</small>
                            <div class="input-group">
                                <input type="number" class="form-control" v-model="interestRate">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="years">{{ __('compound.number_of_years_label') }}:</label>
                            <small>@{{ years }}</small>
                            <input class="form-control" type="number" id="years" v-model="years">
                        </div>
                        <div>
                            <label for="compoundingFrequency">{{ __('compound.compounding_frequency_label') }}:</label>
                            <small>@{{ compoundingFrequency }}</small>
                            <select class="form-control" id="compoundingFrequency" v-model="compoundingFrequency">
                                <option value="1">{{ __('compound.annually') }}</option>
                                <option value="2">{{ __('compound.semi_annually') }}</option>
                                <option value="4">{{ __('compound.quarterly') }}</option>
                                <option value="12">{{ __('compound.monthly') }}</option>
                                <option value="52">{{ __('compound.weekly') }}</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary"
                                @click="calculateCompoundInterest">{{ __('compound.calculate_button') }}</button>
                        </div>
                    </div>
                    <section class="col-md-12">
                        <section class="col-md-12 mt-3" v-if="compoundInterest">
                            <div>
                                <div>
                                    <h2>{{ __('compound.calculation_details_heading') }}</h2>
                                    <p>{{ __('compound.principal_details') }} = $@{{ principal }}</p>
                                    <p>{{ __('compound.annual_interest_rate_details') }} = @{{ interestRate }}%</p>
                                    <p>{{ __('compound.number_of_years_details') }} = @{{ years }}</p>
                                    <p>{{ __('compound.compounding_frequency_details') }} = @{{ compoundingFrequency }} </p>
                                </div>
                                <div>
                                    <h2>{{ __('compound.result_heading') }}</h2>
                                    <p>{{ __('compound.result_description') }}</p>
                                    <strong>A = $@{{ formatNumber(compoundInterest) }}</strong>
                                </div>
                            </div>
                        </section>
                        <div>
                            <div id="chartContainer">
                                <!-- Chart canvas will be inserted here dynamically -->
                            </div>
                        </div>
                        <form v-if="compoundInterest"
                            action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                            method="GET">
                              <input type="hidden" name="value[0]" value="{{__('compound.calculation_details_heading')}}">
                                <input type="hidden" name="value[1]" value="{{__('compound.principal_details')}}">
                                <input type="hidden" name="value[2]" :value="formatNumber(principal)">
                                <input type="hidden" name="value[3]" value="{{__('compound.annual_interest_rate_details')}}">
                                <input type="hidden" name="value[4]" :value="interestRate">
                                <input type="hidden" name="value[5]" value="{{__('compound.number_of_years_details')}}">
                                <input type="hidden" name="value[6]" :value="years">
                                <input type="hidden" name="value[7]" value="{{__('compound.compounding_frequency_details')}}">
                                <input type="hidden" name="value[8]" :value="compoundingFrequency">
                                <input type="hidden" name="value[9]" value="{{__('compound.result_description')}}">
                                <input type="hidden" name="value[10]" :value="formatNumber(compoundInterest)">

                            <button type="submit"
                                class="btn btn-success my-2">{{ __('compound.download_pdf_button') }}</button>
                        </form>
                    </section>
                    <div class="col-md-12">
                        <hr>
                        <h3 class="h4">{{ __('compound.results') }}</h3>
                        <p>
                            {{ __('compound.results_description') }}
                        </p>
                        <h3 class="h4">{{ __('compound.use_cases') }}</h3>
                        <ol>
                            <li>{{ __('compound.investment_planning') }}</li>
                            <li>{{ __('compound.loan_management') }}</li>
                            <li>{{ __('compound.financial_goal_setting') }}</li>
                            <li>{{ __('compound.education') }}</li>
                        </ol>
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
                principal: 1000, // Default principal amount
                interestRate: 5, // Default annual interest rate
                years: 30, // Default number of years
                compoundingFrequency: 1, // Default compounding frequency
                compoundInterest: 0,
            },
            methods: {

                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculateCompoundInterest() {
                    const P = parseFloat(this.principal);
                    const r = parseFloat(this.interestRate) / 100; // Convert to decimal
                    const n = parseFloat(this.compoundingFrequency);
                    const t = parseFloat(this.years);

                    const A = P * Math.pow(1 + r / n, n * t);
                    this.compoundInterest = A.toFixed(2);

                    const labels = [];
                    const data = [];

                    for (let year = 1; year <= t; year++) {
                        const A = P * Math.pow(1 + r / n, n * year);
                        labels.push(`Year ${year}`);
                        data.push(A.toFixed(2));
                    }
                    this.updateChart(labels, data);

                },



                updateChart(labels, data) {

                    // Remove any existing chart container
                    const existingChartContainer = document.getElementById('chartContainer');
                    existingChartContainer.innerHTML = '';

                    // Create a new canvas element
                    const canvas = document.createElement('canvas');
                    canvas.id = 'compoundInterestChart';

                    // Append the canvas to the chart container
                    existingChartContainer.appendChild(canvas);

                    // Create the chart
                    const ctx = canvas.getContext('2d');
                    this.chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Compound Interest',
                                data: data,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Compound Interest ($)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Years'
                                    }
                                }
                            }
                        }
                    });
                },


            },
        });
    </script>
@endsection
