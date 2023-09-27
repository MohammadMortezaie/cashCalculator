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
            <h1>{{__('percentageChangeCalculator.h1')}}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>
                        {{__('percentageChangeCalculator.seoDescription')}}
                    </p>
                    <p>
                        {{__('percentageChangeCalculator.p-1')}}
                    </p>

                    <code>
                        <p>{{__('percentageChangeCalculator.pc')}} = ( {{__('percentageChangeCalculator.nv')}} - {{__('percentageChangeCalculator.ov')}} ) / {{__('percentageChangeCalculator.ov')}} * 100 </p>
                    </code>
                    <ul>
                        <li>
                            <strong>{{__('percentageChangeCalculator.nv')}}:</strong>
                            {{__('percentageChangeCalculator.nv-d')}}
                        </li>
                        <li>
                            <strong>{{__('percentageChangeCalculator.ov')}}:</strong>
                            {{__('percentageChangeCalculator.ov-d')}}
                        </li>
                    </ul>

                    <hr>
                </section>

                <section class="col-md-12">
                    <div class="col-md-12">
                        <!-- Investment input form -->
                        <div class="row">


                            <div class="form-group">


                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{__('percentageChangeCalculator.nv')}}: </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="newNumber">
                                </div>

                                <div class="input-group my-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{__('percentageChangeCalculator.ov')}}: </span>
                                    </div>
                                    <input type="number" class="form-control" v-model="oldNumber">
                                </div>



                                <p> {{__('percentageChangeCalculator.pc')}}: <span class="h5">@{{ percentageChange }}%</span>
                                    <span v-if="changeType == 0">{{__('percentageChangeCalculator.nc')}}</span>
                                    <span v-if="changeType == 1" class="text-danger">{{__('percentageChangeCalculator.dec')}}</span>
                                    <span v-if="changeType == 2" class="text-success">{{__('percentageChangeCalculator.inc')}}</span>
                                </p>

                                <div class="d-flex">
                                    <button class="btn btn-primary mt-2" :disabled="oldNumber == null || newNumber == null"
                                        @click="calculatePercentageChange">{{ __('percentageCalculator.calculate') }}</button>
                                    <form v-if="percentageChange"
                                        action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                        method="GET" class="ml-2">
                                        <input type="hidden" name="value[0]" :value="`{{ __('percentageChangeCalculator.nv') }} : ${newNumber}  -  {{ __('percentageChangeCalculator.ov') }} ${oldNumber} :`">
                                        <input type="hidden" name="value[1]" :value="`${percentageChange}`">
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
                oldNumber: null,
                newNumber: null,
                percentageChange: null,
                changeType: null,
            },

            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculatePercentageChange() {
                    const percentageChange = ((this.newNumber - this.oldNumber) / this.oldNumber) * 100;
                    this.percentageChange = percentageChange.toFixed(2);

                    if (percentageChange > 0) {
                        this.changeType = 2;
                    } else if (percentageChange < 0) {
                        this.changeType = 1;
                    } else {
                        this.changeType = 0;
                    }
                }
            },

        });
    </script>
@endsection
