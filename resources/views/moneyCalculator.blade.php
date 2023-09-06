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
            <h1>{{ __('moneyCalculator.h1') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <h2 class="h3">{{ __('moneyCalculator.IET') }}</h2>
                    <p>{{ __('moneyCalculator.top-p-1') }}</p>

                    <p>{{ __('moneyCalculator.top-p-2') }}</p>
                    <div class="row col-md-12">

                        <div class="col-md-6">
                            <ul>
                                <li>{{ __('moneyCalculator.USD') }}</li>
                                <li>{{ __('moneyCalculator.EUR') }}</li>
                                <li>{{ __('moneyCalculator.CAD') }}</li>
                                <li>{{ __('moneyCalculator.AUD') }}</li>
                                <li>{{ __('moneyCalculator.SEK') }}</li>
                                <li>{{ __('moneyCalculator.MXN') }}</li>
                                <li>{{ __('moneyCalculator.NZD') }}</li>
                                <li>{{ __('moneyCalculator.BRL') }}</li>
                                <li>{{ __('moneyCalculator.RUB') }}</li>
                                <li>{{ __('moneyCalculator.KRW') }}</li>
                                <li>{{ __('moneyCalculator.CNY') }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <img class="w-100"
                                src="https://www.gourmetads.com/wp-content/uploads/2019/02/970x250-starbucks-nitro.jpg">
                        </div>
                    </div>
                    <hr>
                </section>

                <section class="col-md-12 row">
                    <div class="col-md-4">

                        <!-- Currency Selection -->
                        <label class="h4" for="currencySelect">{{ __('moneyCalculator.SC') }}:</label>
                        <select class="form-control" id="currencySelect" v-model="selectedCurrency">
                            <option value="USD">{{ __('moneyCalculator.USD') }}</option>
                            <option value="EUR">{{ __('moneyCalculator.EUR') }}</option>
                            <option value="CAD">{{ __('moneyCalculator.CAD') }}</option>
                            <option value="AUD">{{ __('moneyCalculator.AUD') }}</option>
                            <option value="SEK">{{ __('moneyCalculator.SEK') }}</option>
                            <option value="MXN">{{ __('moneyCalculator.MXN') }}</option>
                            <option value="NZD">{{ __('moneyCalculator.NZD') }}</option>
                            <option value="BRL">{{ __('moneyCalculator.BRL') }}</option>
                            <option value="RUB">{{ __('moneyCalculator.RUB') }}</option>
                            <option value="KRW">{{ __('moneyCalculator.KRW') }}</option>
                            <option value="CNY">{{ __('moneyCalculator.CNY') }}</option>
                        </select>
                    </div>


                    <div class="col-md-4">
                        <h4>{{ __('moneyCalculator.Bills') }}</h4>
                        <!-- These will be populated dynamically based on the selected currency -->
                        <div v-for="(quantity, denomination) in selectedCurrencyData.cash">
                            <label class="mt-1 mb-0" :for="denomination">{{ __('moneyCalculator.HowMany') }}
                                @{{ denomination }} @{{ selectedCurrencyData.name }}
                                {{ __('moneyCalculator.Bills') }}?</label>
                            <input type="number" class="form-control" min="1" :id="denomination"
                                v-model="selectedCurrencyData.cash[denomination]">
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <h4>{{ __('moneyCalculator.Coins') }}</h4>
                        <div v-for="(quantity, denomination) in selectedCurrencyData.coins">
                            <label class="mt-1 mb-0" :for="denomination">{{ __('moneyCalculator.HowMany') }}
                                @{{ denomination }} @{{ selectedCurrencyData.name }}
                                {{ __('moneyCalculator.Coin') }}?</label>
                            <input type="number" class="form-control" min="1" :id="denomination"
                                v-model="selectedCurrencyData.coins[denomination]">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary my-2"
                            @click="calculateTotal">{{ __('moneyCalculator.CalculateTotal') }}</button>
                    </div>

                </section>

                <section class="col-md-12 mt-3">
                    <img class="w-100"
                        src="https://www.gourmetads.com/wp-content/uploads/2019/02/970x250-starbucks-nitro.jpg">
                </section>

                <section class="col-md-12 mt-3">

                    <!-- The total amount will be displayed here -->
                    <h3 id="totalDisplay"> <span class="h4">{{ __('moneyCalculator.TotalAmount') }} </span>
                        @{{ formatNumber(total) }} @{{ selectedCurrency }}</h3>
                    <button class="btn btn-success my-2">{{ __('moneyCalculator.DownloadPDF') }}</button>
                    <hr>
                    <h2 class="h3">{{ __('moneyCalculator.botton-h3') }}</h2>
                    <p>{{ __('moneyCalculator.botton-p') }}</p>

                    <h4>{{ __('moneyCalculator.botton-h4-1') }}</h4>
                    <p>{{ __('moneyCalculator.botton-p-1') }}</p>

                    <h4>{{ __('moneyCalculator.botton-h4-2') }}</h4>
                    <p>{{ __('moneyCalculator.botton-p-2') }}</p>

                    <h4>{{ __('moneyCalculator.botton-h4-3') }}</h4>
                    <p>{{ __('moneyCalculator.botton-p-3') }}</p>


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
                total: 0,
                selectedCurrency: 'USD',
                currencies: {
                    USD: {
                        name: 'US Dollar',
                        cash: {
                            1: '',
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        },
                        coins: {
                            0.01: '',
                            0.05: '',
                            0.1: '',
                            0.25: ''
                        }
                    },
                    EUR: {
                        name: 'Euro',
                        cash: {
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: '',
                            200: ''
                        },
                        coins: {
                            0.01: '',
                            0.02: '',
                            0.05: '',
                            0.1: '',
                            0.2: '',
                            0.5: '',
                            1: '',
                            2: ''
                        }
                    },
                    AUD: {
                        name: 'Australian Dollar',
                        cash: {
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        },
                        coins: {
                            0.05: '',
                            0.1: '',
                            0.2: '',
                            0.5: '',
                            1: '',
                            2: ''
                        }
                    },
                    CAD: {
                        name: 'Canadian Dollar',
                        cash: {
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        },
                        coins: {
                            0.01: '',
                            0.05: '',
                            0.1: '',
                            0.25: '',
                            1: '',
                            2: ''
                        }
                    },
                    SEK: {
                        name: 'Swedish Krona',
                        cash: {
                            20: '',
                            50: '',
                            100: '',
                            200: '',
                            500: ''
                        },
                        coins: {
                            1: '',
                            2: '',
                            5: '',
                            10: ''
                        }
                    },
                    MXN: {
                        name: 'Mexican Peso',
                        cash: {
                            20: '',
                            50: '',
                            100: '',
                            200: '',
                            500: '',
                            1000: ''
                        },
                        coins: {
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        }
                    },
                    NZD: {
                        name: 'New Zealand Dollar',
                        cash: {
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: '',
                            200: ''
                        },
                        coins: {
                            0.1: '',
                            0.2: '',
                            0.5: '',
                            1: '',
                            2: ''
                        }
                    },
                    BRL: {
                        name: 'Brazilian Real',
                        cash: {
                            2: '',
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        },
                        coins: {
                            0.01: '',
                            0.05: '',
                            0.1: '',
                            0.25: '',
                            0.5: '',
                            1: ''
                        }
                    },
                    RUB: {
                        name: 'Russian Ruble',
                        cash: {
                            10: '',
                            50: '',
                            100: '',
                            200: '',
                            500: '',
                            1000: '',
                            2000: ''
                        },
                        coins: {
                            1: '',
                            2: '',
                            5: '',
                            10: ''
                        }
                    },
                    KRW: {
                        name: 'South Korean Won',
                        cash: {
                            1000: '',
                            5000: '',
                            10000: '',
                            50000: '',
                        },
                        coins: {
                            10: '',
                            50: '',
                            100: '',
                            500: '',
                        }
                    },
                    CNY: {
                        name: 'Chinese Yuan',
                        cash: {
                            1: '',
                            5: '',
                            10: '',
                            20: '',
                            50: '',
                            100: ''
                        },
                        coins: {
                            0.1: '',
                            0.5: '',
                            1: '',
                            5: ''
                        }
                    },

                }

            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                calculateTotal() {
                    const currency = this.selectedCurrencyInfo; // Updated property name
                    let total = 0;

                    // Iterate through cash denominations and calculate the total
                    for (const denomination in currency.cash) {
                        total += denomination * (parseInt(currency.cash[denomination]) || 0);
                    }

                    // Iterate through coin denominations and calculate the total
                    for (const denomination in currency.coins) {
                        total += denomination * (parseFloat(currency.coins[denomination]) || 0);
                    }

                    this.total = total;

                    // Scroll to the element with the id "totalDisplay" after calculating the total
                    const totalDisplayElement = document.getElementById('totalDisplay');
                    if (totalDisplayElement) {
                        totalDisplayElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                },
            },
            computed: {
                selectedCurrencyInfo() { // Updated computed property name
                    return this.currencies[this.selectedCurrency];
                },
                selectedCurrencyData() {
                    return this.currencies[this.selectedCurrency];
                },
            },
            watch: {
                selectedCurrency() {
                    this.total = 0;
                }
            }
        });
    </script>
@endsection
