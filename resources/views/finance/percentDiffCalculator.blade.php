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
            <h1>{{__('percentDiffCalculator.h1')}}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>
                        {{__('percentDiffCalculator.p1')}}
                    </p>
                    <hr>
                    <p class="h6 alert alert-info col-12">
                        <code>
                            (|v1 - v2| / [(v1 + v2) / 2]) * 100
                        </code>
                    </p>

                    <ul>
                        <li><strong>v1</strong> : {{__('percentDiffCalculator.oldv')}}</li>
                        <li><strong>v2</strong> : {{__('percentDiffCalculator.newv')}}</li>
                    </ul>
                    <ul>
                        <hr>
                        <li>
                            <strong>{{__('percentDiffCalculator.title-1')}}: |v1 - v2| </strong><br>
                            <span>
                                {{__('percentDiffCalculator.desc-1')}}
                            </span>
                        </li>

                        <li>
                            <strong>{{__('percentDiffCalculator.title-2')}}: (v1 + v2) / 2 </strong><br>
                            <span>

                                {{__('percentDiffCalculator.desc-2')}}
                            </span>
                        </li>


                        <li>
                            <strong>{{__('percentDiffCalculator.title-3')}}: |v1 - v2| / [(v1 + v2) / 2] </strong> <br>
                            <span>
                                {{__('percentDiffCalculator.desc-3')}}
                            </span>
                        </li>

                        <li>
                            <strong>{{__('percentDiffCalculator.title-4')}}: [(|v1 - v2| / [(v1 + v2) / 2]) * 100 </strong> <br>
                            <span>
                                {{__('percentDiffCalculator.desc-4')}}
                            </span>
                        </li>
                    </ul>





                    <hr>
                </section>

                <section class="col-md-12">
                    <!-- Investment input form -->
                    <div class="row">


                        <div class="form-group col-md-12">
                            <code class="text-primary">
                                (| @{{ v1 }} - @{{ v2 }} | / [( @{{ v1 }} +
                                @{{ v2 }} ) / 2]) * 100
                            </code>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">V1: </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="v1">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">V2: </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="v2">
                                </div>
                            </div>

                            <div class="form-group">

                                <button class="btn btn-primary" @click="calculatePercentageDifference">{{__('percentageCalculator.calculate')}}</button>
                            </div>


                            <h4>@{{ formatNumber(result) }}% </h4>

                            <div class="form-group col-md-12" v-if="result">
                                <form
                                    action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                    method="GET" class="ml-2">
                                    <input type="hidden" name="value[0]"
                                        :value="`(| ${v1} - ${v2} | / [( ${v1} + ${v2} ) / 2]) * 100`">
                                    <input type="hidden" name="value[1]" :value="`v1: ${v1}`">
                                    <input type="hidden" name="value[2]" :value="`v2: ${v2}`">
                                    <input type="hidden" name="value[3]" :value="result">
                                    <button type="submit"
                                        class="btn btn-success mt-2 ">{{ __('percentDiffCalculator.download_pdf_button') }}</button>
                                </form>

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
                v1: '',
                v2: '',
                result: null
            },

            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculatePercentageDifference: function() {
                    if (this.v1 !== null && this.v2 !== null) {
                        const absoluteDifference = Math.abs(this.v1 - this.v2);
                        const average = (Number(this.v1) + Number(this.v2)) / 2;
                        this.result = (absoluteDifference / average) * 100;
                    } else {
                        this.result = null;
                    }
                }
            },

        });
    </script>
@endsection
