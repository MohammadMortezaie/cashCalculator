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
            <h1>{{ __('percentageCalculator.seoTitle') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <h4>{{ __('percentageCalculator.h4') }}</h4>
                    <p> {{ __('percentageCalculator.p-1') }} </p>
                    <p>{{ __('percentageCalculator.seoDescription') }}</p>
                    <hr>
                </section>

                <section class="col-md-12">
                    <div class="col-md-12">
                        <!-- Investment input form -->
                        <div class="row">

                            <div class="form-group">
                                <h5>{{ __('percentageCalculator.f1-1') }} @{{ percentageOfNumber1 }}%
                                    {{ __('percentageCalculator.f1-2') }} @{{ formatNumber(percentageOfNumber2) }} ?</h5>
                                <p class="h5 text-success" v-if="percentageOfResult">{{ __('percentageCalculator.result') }}:
                                    <span class="h3">@{{ formatNumber(percentageOfResult) }}</span>
                                </p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('percentageCalculator.f1-1') }}</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="percentageOfNumber1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">% {{ __('percentageCalculator.f1-2') }} </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="percentageOfNumber2">
                                    <div class="input-group-append">
                                        <span class="input-group-text">?</span>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-primary mt-2"
                                        @click="calculatePercentageOf">{{ __('percentageCalculator.calculate') }}</button>
                                    <form v-if="percentageOfResult"
                                        action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                        method="GET" class="ml-2">
                                        <input type="hidden" name="value[0]"
                                            :value="`{{ __('percentageCalculator.f1-1') }} ${percentageOfNumber1}% {{ __('percentageCalculator.f1-2') }} ${percentageOfNumber2} ?`">
                                        <input type="hidden" name="value[1]" :value="percentageOfNumber1">
                                        <button type="submit"
                                            class="btn btn-success mt-2 ">{{ __('investmentCalculator.download_pdf_button') }}</button>
                                    </form>
                                </div>
                                <hr>
                            </div>

                            <div class="form-group">
                                <h5>@{{ formatNumber(percentOfNumber1) }} {{ __('percentageCalculator.f2-1') }} @{{ formatNumber(percentOfNumber2) }} ?
                                </h5>
                                <p class="h5 text-success" v-if="percentOfResult">{{ __('percentageCalculator.result') }}:
                                    <span class="h3">@{{ percentOfResult }}</span>
                                </p>

                                <div class="input-group">
                                    <input type="number" class="form-control" v-model="percentOfNumber1">
                                    <div class="input-group-append">
                                        <span class="input-group-text"> {{ __('percentageCalculator.f2-1') }} </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="percentOfNumber2">
                                    <div class="input-group-append">
                                        <span class="input-group-text">?</span>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-primary mt-2"
                                        @click="calculatePercentOf">{{ __('percentageCalculator.calculate') }}</button>
                                    <form v-if="percentOfResult"
                                        action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                        method="GET" class="ml-2">
                                        <input type="hidden" name="value[0]"
                                            :value="` ${percentOfNumber1} {{ __('percentageCalculator.f2-1') }} ${percentOfNumber2} ?`">
                                        <input type="hidden" name="value[1]" :value="percentOfResult">
                                        <button type="submit"
                                            class="btn btn-success mt-2 ">{{ __('investmentCalculator.download_pdf_button') }}</button>
                                    </form>
                                </div>
                                <hr>
                            </div>

                            <div class="form-group">
                                <h5>{{ __('percentageCalculator.f3-1') }} @{{ formatNumber(percentageChangeNumber1) }}
                                    {{ __('percentageCalculator.to') }}
                                    @{{ formatNumber(percentageChangeNumber2) }} ?</h5>
                                <p class="h5 text-success" v-if="percentageChangeResult">
                                    {{ __('percentageCalculator.result') }}: <span class="h3">@{{ formatNumber(percentageChangeResult) }}
                                        %</span></p>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ __('percentageCalculator.f3-1') }}</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="percentageChangeNumber1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ __('percentageCalculator.to') }}</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="percentageChangeNumber2">
                                    <div class="input-group-append">
                                        <span class="input-group-text">?</span>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button class="btn btn-primary mt-2"
                                        @click="calculatePercentageChange">{{ __('percentageCalculator.calculate') }}</button>
                                    <form v-if="percentageChangeResult"
                                        action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                        method="GET" class="ml-2">
                                        <input type="hidden" name="value[0]"
                                            :value="`{{ __('percentageCalculator.f3-1') }} ${percentageChangeNumber1} {{ __('percentageCalculator.to') }} ${percentageChangeNumber2} ?`">
                                        <input type="hidden" name="value[1]" :value="percentageChangeResult">
                                        <button type="submit"
                                            class="btn btn-success mt-2 ">{{ __('investmentCalculator.download_pdf_button') }}</button>
                                    </form>
                                </div>

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
                percentageOfNumber1: "",
                percentageOfNumber2: "",
                percentOfNumber1: "",
                percentOfNumber2: "",
                percentageChangeNumber1: "",
                percentageChangeNumber2: "",
                percentageOfResult: "",
                percentOfResult: "",
                percentageChangeResult: "",

            },

            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculatePercentageOf() {
                    const number1 = parseFloat(this.percentageOfNumber1);
                    const number2 = parseFloat(this.percentageOfNumber2);

                    if (!isNaN(number1) && !isNaN(number2)) {
                        const result = (number1 * number2) / 100;
                        this.percentageOfResult = result.toFixed(2);
                    } else {
                        this.percentageOfResult = "Please enter valid numbers.";
                    }
                },
                calculatePercentOf() {
                    const percent = parseFloat(this.percentOfNumber1);
                    const number2 = parseFloat(this.percentOfNumber2);

                    if (!isNaN(percent) && !isNaN(number2)) {
                        const result = (percent / number2) * 100;
                        this.percentOfResult = result.toFixed(2);
                    } else {
                        this.percentOfResult = "Please enter valid numbers.";
                    }
                },
                calculatePercentageChange() {
                    const initialNumber = parseFloat(this.percentageChangeNumber1);
                    const finalNumber = parseFloat(this.percentageChangeNumber2);

                    if (!isNaN(initialNumber) && !isNaN(finalNumber)) {
                        const mines = (finalNumber - initialNumber);
                        const percentChange = (mines / Math.abs(initialNumber)) * 100;
                        this.percentageChangeResult = percentChange.toFixed(2);
                    } else {
                        this.percentageChangeResult = "Please enter valid numbers.";
                    }
                },

            },

        });
    </script>
@endsection
