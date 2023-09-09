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
            <h1> {{ __('503020.h1') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <h2 class="h3">{{ __('503020.h1') }}</h2>
                    <p>{{ __('503020.top-p-1') }}</p>

                    <p>{{ __('503020.top-p-2') }}</p>
                    <hr>
                </section>

                <section class="col-md-12 row">
                    <div class="col-md-6">
                        <label class="h5" for="Income">{{ __('503020.salaryIncome') }} :
                            <span>@{{ formatNumber(salary) }}</span></label>

                        <input class="form-control" type="number" min="1" v-model="salary"
                            placeholder="{{ __('503020.salaryIncome') }}" />

                        <div class="mt-3">
                            <p> {{ __('503020.top-p-3-1') }} $@{{ formatNumber(salary) }} {{ __('503020.top-p-3-1') }} </p>
                            <ul>
                                <li class="h6 my-4">
                                    50% of @{{ salary }} {{ __('503020.necessities') }}<br>
                                    ( @{{ salary }} × 50) / 100 = $<strong>@{{ formatNumber(T50) }} </strong>
                                </li>
                                <li class="h6 my-4">
                                    30% of $ @{{ salary }} {{ __('503020.wants') }} <br>
                                    ( @{{ salary }} × 30) / 100 = $<strong>@{{ formatNumber(T30) }} </strong>
                                </li>
                                <li class="h6 my-4">
                                    20% of $ @{{ salary }} {{ __('503020.savings') }} <br>
                                    ( @{{ salary }} × 20) / 100 = $<strong>@{{ formatNumber(T20) }} </strong>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div>
                        <canvas id="my-pie-chart" width="400" height="400"></canvas>
                    </div>
                </section>

                <section class="col-md-6 mt-3">


                    <form action="{{ route('pdf.budget503020', ['locale' => collect(request()->segments())[0]], true) }}"
                        method="GET">
                        <input type="hidden" name="salary" :value="formatNumber(salary)">
                        <input type="hidden" name="T50" :value="formatNumber(T50)">
                        <input type="hidden" name="T30" :value="formatNumber(T30)">
                        <input type="hidden" name="T20" :value="formatNumber(T20)">
                        <button type="submit" class="btn btn-success my-2">{{ __('BudgetPlanner.DownloadPDF') }}</button>
                    </form>
                </section>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get the canvas element by its id
            var ctx = document.getElementById("my-pie-chart").getContext("2d");

            // Define the data for the pie chart
            var data = {
                labels: ["Needs (T50)", "Wants (T30)", "Savings (T20)"], // Update labels
                datasets: [{
                    data: [50, 30, 20], // Use Vue data values
                    backgroundColor: ["#3498db", "#e74c3c", "#2ecc71"]
                }]
            };
            // Create a new pie chart
            var myPieChart = new Chart(ctx, {
                type: "pie",
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: "50/30/20"
                    }
                }
            });
        });
    </script>


    <script>
        new Vue({
            el: "#app",
            data: {
                salary: 2000,
                T50: 1000,
                T30: 600,
                T20: 400,
            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
            },
            watch:{
                salary(newVal){
                    this.T20 = (newVal * 20) / 100;
                    this.T30 = (newVal * 30) / 100;
                    this.T50 = (newVal * 50) / 100;
                }
            }
        });
    </script>
@endsection
