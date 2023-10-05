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
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
@endsection

@section('content')
    <div id="app">
        <div class="header-content">
            <h1>{{__('bmi.h1')}}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <strong>{{__('bmi.bmiintro')}}</strong>
                    <p>{{__('bmi.p-1')}}</p>
                    <p>
                        {{__('bmi.p-2')}}
                    </p>
                    <p>
                        {{__('bmi.p-3')}}
                    </p>
                    <div style="text-align: center" class="w-100">
                        <img class="img-fluid" alt="BMI-Chart-1024x708"
                            src="https://www.lipedema.net/wp-content/uploads/2021/02/BMI-Chart-1024x708.png"
                            style="max-height: 400px; text-align: center" />
                    </div>
                    <hr>
                </section>

                <section class="col-md-12">
                    <div class="col-md-12">
                        <!-- Investment input form -->
                        <div class="row">

                            <div class="col-md-5 form-group">
                                <div class="mb-3">
                                    <label for="gender">{{__('bmi.gender')}}: <span v-if="gender == 1">{{__('bmi.male')}}</span> <span
                                            v-if="gender == 2">{{__('bmi.female')}}</span> </label>
                                    <select class="form-control" v-model="gender" id="gender" class="form-select">
                                        <option value="1">{{__('bmi.male')}}</option>
                                        <option value="2">{{__('bmi.female')}}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="age">{{__('bmi.age')}}: @{{ age }}</label>
                                    <input v-model="age" type="number" id="age" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="weight">{{__('bmi.weight')}} (kg): @{{ weight }} kg</label>
                                    <input v-model="weight" type="number" id="weight" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="height">{{__('bmi.height')}} (cm): @{{ height }} cm</label>
                                    <input v-model="height" type="number" id="height" class="form-control">
                                </div>

                                <button @click="calculateBMI" class="btn btn-primary">{{__('bmi.calBmi')}}</button>

                                <div class="d-flex">
                                    <form v-if="bmi"
                                        action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                        method="GET">

                                        <input type="hidden" name="value[0]" value="{{__('bmi.bmi_result')}}">
                                        <input type="hidden" name="value[1]" :value=" bmi.toFixed(2) ">

                                        <button type="submit"
                                            class="btn btn-success mt-2 ">{{ __('investmentCalculator.download_pdf_button') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="col-md-8 mt-0 pt-0" v-if="bmi !== null">
                                    <div class="result mt-4">
                                        <h3>@lang('bmi.bmi_result')</h3>
                                        <p>@lang('bmi.your_bmi') <strong class="h4 font-weight-bold">@{{ bmi.toFixed(2) }}</strong></p>
                                        <p v-if="bmiCategory == 1">@lang('bmi.underweight')</p>
                                        <p v-if="bmiCategory == 2">@lang('bmi.normal_weight')</p>
                                        <p v-if="bmiCategory == 3">@lang('bmi.overweight')</p>
                                        <p v-if="bmiCategory == 4">@lang('bmi.obese')</p>

                                        <p>@lang('bmi.who_recommendation')</p>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('bmi.classification')</th>
                                                    <th>@lang('bmi.bmi_range')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>@lang('bmi.severe_thinness')</td>
                                                    <td>&lt; 16</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.moderate_thinness')</td>
                                                    <td>16 - 17</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.mild_thinness')</td>
                                                    <td>17 - 18.5</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.normal')</td>
                                                    <td>18.5 - 25</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.overweight')</td>
                                                    <td>25 - 30</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.obese_class_i')</td>
                                                    <td>30 - 35</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.obese_class_ii')</td>
                                                    <td>35 - 40</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('bmi.obese_class_iii')</td>
                                                    <td>&gt; 40</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                </div>


                                <canvas id="chartContainer" class="chart-container"></canvas>

                            </div>
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
                gender: 1,
                age: 30,
                weight: 70,
                height: 179,
                bmi: null,
                bmiCategory: null,
                bmiChartData: null,
                classifications: [
                    'Severe Thinness',
                    'Moderate Thinness',
                    'Mild Thinness',
                    'Normal',
                    'Overweight',
                    'Obese Class I',
                    'Obese Class II',
                    'Obese Class III'
                ],
                bmiRanges: [{
                        label: '< 16',
                        min: 0,
                        max: 16
                    },
                    {
                        label: '16 - 17',
                        min: 16,
                        max: 17
                    },
                    {
                        label: '17 - 18.5',
                        min: 17,
                        max: 18.5
                    },
                    {
                        label: '18.5 - 25',
                        min: 18.5,
                        max: 25
                    },
                    {
                        label: '25 - 30',
                        min: 25,
                        max: 30
                    },
                    {
                        label: '30 - 35',
                        min: 30,
                        max: 35
                    },
                    {
                        label: '35 - 40',
                        min: 35,
                        max: 40
                    },
                    {
                        label: '> 40',
                        min: 40,
                        max: Number.POSITIVE_INFINITY
                    }
                ],
            },

            methods: {
                calculateBMI() {
                    if (this.weight && this.height) {
                        const heightInMeters = this.height / 100;
                        let bmi = this.weight / (heightInMeters * heightInMeters);

                        // Adjust BMI based on gender and age
                        if (this.gender == 2) {
                            bmi += 0.5; // Add 0.5 to BMI for females
                        }

                        if (this.age >= 50) {
                            bmi += 1.0; // Add 1.0 to BMI for individuals over 50
                        }

                        this.bmi = bmi;
                        this.updateBMIChart();
                    }
                },
                getBMICategory() {
                    if (this.bmi < 18.5) {
                        this.bmiCategory = 1;
                    } else if (this.bmi < 24.9) {
                        this.bmiCategory = 2;
                    } else if (this.bmi < 29.9) {
                        this.bmiCategory = 3;
                    } else {
                        this.bmiCategory = 4;
                    }
                },
                updateBMIChart() {
                    if (this.bmi !== null) {


                        const ctx = document.getElementById('chartContainer');
                        if (this.bmiChart) {
                            this.bmiChart.destroy();
                        }

                        const data = this.bmiRanges.map(range => {
                            return this.bmi >= range.min && this.bmi <= range.max ? 1 : 0;
                        });
                        this.bmiChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: this.classifications,
                                datasets: [{
                                    label: 'BMI Range',
                                    data: data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                }],
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                    },
                                },
                            },
                        });
                    }
                },

            },
        });
    </script>
@endsection
