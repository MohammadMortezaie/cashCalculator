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
            <h1>{{ __('debtPayoff.free_debt_calculator_title') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <p>{{ __('debtPayoff.seoDescription') }}</p>
                    <p>{{ __('debtPayoff.free_debt_calculator_description') }}</p>
                    <ul>
                        <li>
                            <h4>{{ __('debtPayoff.total_debt_amount') }}</h4>
                            <p>{{ __('debtPayoff.total_debt_amount_description') }}</p>
                        </li>

                        <li>
                            <h4>{{ __('debtPayoff.interest_rate') }}</h4>
                            <p>{{ __('debtPayoff.interest_rate_description') }}</p>
                        </li>

                        <li>
                            <h4>{{ __('debtPayoff.payment_frequency') }}</h4>
                            <p>{{ __('debtPayoff.payment_frequency_description') }}</p>
                        </li>
                    </ul>
                    <hr>
                </section>

                <section class="col-md-12">
                    <div class="col-md-12">
                        <h1>{{ __('debtPayoff.debt_calculator_title') }}</h1>

                        <!-- Debt input form -->
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <label>{{ __('debtPayoff.total_debt_amount') }}:</label>
                                <small>$@{{ formatNumber(currentDebt.totalDebt) }}</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="currentDebt.totalDebt">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ __('debtPayoff.interest_rate') }}:</label>
                                    <small>@{{ currentDebt.interestRate }}%</small>
                                    <div class="input-group">
                                        <input type="number" class="form-control" v-model="currentDebt.interestRate">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="monthlyPayment">
                                    <span v-if="currentDebt.paymentFrequency == 1">{{ __('debtPayoff.monthly') }}</span>
                                    <span v-if="currentDebt.paymentFrequency == 2">{{ __('debtPayoff.bi_weekly') }}</span>
                                    <span v-if="currentDebt.paymentFrequency == 3">{{ __('debtPayoff.weekly') }}</span>
                                    {{ __('debtPayoff.payment') }}:
                                </label>
                                <small>$@{{ formatNumber(currentDebt.monthlyPayment) }}</small>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="currentDebt.monthlyPayment">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="paymentFrequency">{{ __('debtPayoff.payment_frequency') }}</label>
                                    <select class="form-control" v-model="currentDebt.paymentFrequency"
                                        id="paymentFrequency">
                                        <option value="1">{{ __('debtPayoff.monthly') }}</option>
                                        <option value="2">{{ __('debtPayoff.bi_weekly') }}</option>
                                        <option value="3">{{ __('debtPayoff.weekly') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary"
                                @click="addDebt">{{ __('debtPayoff.add_debt_button') }}</button>
                        </div>
                    </div>

                    <!-- Debt list -->
                    <div class="mt-4  table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">{{ __('debtPayoff.debt_number') }}</th>
                                    <th scope="col">{{ __('debtPayoff.total_debt_amount') }} ($)</th>
                                    <th scope="col">{{ __('debtPayoff.interest_rate') }} (%)</th>
                                    <th scope="col">{{ __('debtPayoff.payment_amount') }} ($)</th>
                                    <th scope="col">{{ __('debtPayoff.payment_frequency') }}</th>
                                    <th scope="col">{{ __('debtPayoff.frequency_needed_to_pay_off') }}</th>
                                    <th scope="col">{{ __('debtPayoff.total_paid') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(debt, index) in debts" :key="index">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ formatNumber(debt.totalDebt) }}</td>
                                    <td>@{{ debt.interestRate }}</td>
                                    <td>@{{ formatNumber(debt.monthlyPayment) }}</td>
                                    <td v-if="debt.paymentFrequency == 1">{{ __('debtPayoff.monthly') }}</td>
                                    <td v-if="debt.paymentFrequency == 2">{{ __('debtPayoff.bi_weekly') }}</td>
                                    <td v-if="debt.paymentFrequency == 3">{{ __('debtPayoff.weekly') }}</td>
                                    <td>@{{ debt.payoffDetails.monthsToPayoff }}</td>
                                    <td>@{{ formatNumber(debt.payoffDetails.totalPaid) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <section class="col-md-6" v-for="(debt, debtIndex) in debts" :key="debtIndex">
                        <h3>{{ __('debtPayoff.debt_details_title') }} @{{ debtIndex + 1 }}</h3>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">{{ __('debtPayoff.payment_frequency') }}</th>
                                    <th scope="col">{{ __('debtPayoff.payment_amount') }}</th>
                                    <th scope="col">{{ __('debtPayoff.total_paid') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(payment, monthIndex) in debt.paymentDetails" :key="monthIndex">
                                    <td v-if="debt.paymentFrequency == 1">{{ __('debtPayoff.monthly') }}</td>
                                    <td v-if="debt.paymentFrequency == 2">{{ __('debtPayoff.bi_weekly') }}</td>
                                    <td v-if="debt.paymentFrequency == 3">{{ __('debtPayoff.weekly') }}</td>
                                    <td>@{{ formatNumber(debt.monthlyPayment) }}</td>
                                    <td>@{{ formatNumber(payment.totalPaid) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <section class="col-md-12 mt-3">
                            <form
                                action="{{ route('pdf.globalPDF', ['locale' => collect(request()->segments())[0]], true) }}"
                                method="GET">
                                <input type="hidden" name="header[1]" value="{{ __('debtPayoff.total_debt_amount') }}">
                                <input type="hidden" name="header[2]" value="{{ __('debtPayoff.interest_rate') }}">
                                <input type="hidden" name="header[3]" value="{{ __('debtPayoff.payment_amount') }}">
                                <input type="hidden" name="header[5]"
                                    value="{{ __('debtPayoff.frequency_needed_to_pay_off') }}">
                                <input type="hidden" name="header[6]" value="{{ __('debtPayoff.total_paid') }}">
                                <input type="hidden" name="table[0]" :value="JSON.stringify(pdfData)">
                                <button type="submit"
                                    class="btn btn-success my-2">{{ __('debtPayoff.download_pdf_button') }}</button>
                            </form>
                        </section>

                    </section>

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
                currentDebt: {
                    totalDebt: 10000,
                    interestRate: 5,
                    monthlyPayment: 200,
                    paymentFrequency: 1,
                    payoffDetails: {
                        monthsToPayoff: 0,
                        totalPaid: 0,
                    },
                },
                pdfData: [],
                debts: [],
            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                addDebt() {
                    // Clone the currentDebt object to avoid modifying existing debts
                    const newDebt = {
                        ...this.currentDebt,
                        paymentDetails: [], // Initialize an empty array for payment details
                    };

                    // Calculate the payoff details for the new debt
                    this.calculatePayoff(newDebt);

                    // Calculate and populate the payment details for each month
                    let remainingDebt = newDebt.totalDebt;
                    for (let month = 0; month < newDebt.payoffDetails.monthsToPayoff; month++) {
                        const monthlyInterest = remainingDebt * (newDebt.interestRate / 100 / 12);
                        const principalPayment = newDebt.monthlyPayment - monthlyInterest;
                        remainingDebt -= principalPayment;

                        // Add payment details for the current month to the debt
                        newDebt.paymentDetails.push({
                            totalPaid: newDebt.monthlyPayment * (month + 1),
                        });
                    }

                    // Add the new debt to the list of debts
                    this.debts.push(newDebt);

                    // Reset the current debt input fields
                    this.currentDebt = {
                        totalDebt: 0,
                        interestRate: 0,
                        monthlyPayment: 0,
                        paymentFrequency: 1,
                        payoffDetails: {
                            monthsToPayoff: 0,
                            totalPaid: 0,
                        },
                    };
                },


                calculatePayoff(debt) {
                    // Convert annual interest rate to monthly decimal
                    const monthlyInterestRate = debt.interestRate / 100 / 12;

                    // Initialize variables for calculation
                    let remainingDebt = debt.totalDebt;
                    let monthsToPayoff = 0;
                    let totalPaid = 0;

                    while (remainingDebt > 0) {
                        // Calculate interest for the current month
                        const monthlyInterest = remainingDebt * monthlyInterestRate;

                        // Calculate the portion of the monthly payment that goes towards principal
                        const principalPayment = debt.monthlyPayment - monthlyInterest;

                        // Update the remaining debt
                        remainingDebt -= principalPayment;

                        // Increment the months counter
                        monthsToPayoff++;

                        // Accumulate the total amount paid
                        totalPaid += parseInt(debt.monthlyPayment);
                        console.log(debt.monthlyPayment);
                        console.log(totalPaid);

                        // Handle the case where the debt can't be paid off with the given payment
                        if (remainingDebt <= 0) {
                            break;
                        }
                    }
                    // Set the payoff details for the current debt
                    debt.payoffDetails = {
                        monthsToPayoff,
                        totalPaid,
                    };

                    this.pdfData.push({
                        0: debt.totalDebt,
                        1: debt.interestRate,
                        2: debt.monthlyPayment,
                        3: monthsToPayoff,
                        4: totalPaid
                    });

                },


            },
        });
    </script>
@endsection
