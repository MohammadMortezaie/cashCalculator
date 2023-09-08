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
            <h1>{{ __('BudgetPlanner.h1') }}</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <h2 class="h3">{{ __('BudgetPlanner.IET') }}</h2>
                    <p>{{ __('BudgetPlanner.top-p-1') }}</p>

                    <p>{{ __('BudgetPlanner.top-p-2') }}</p>
                    <hr>
                </section>

                <section class="col-md-12 row">
                    <div class="col-md-4">
                        <label class="h5" for="Income">{{ __('BudgetPlanner.TIncome') }}
                            <span>@{{ formatNumber(income) }}</span></label>

                        <div v-for="(field, index) in incomeFields" :key="index" class="input-group mb-2">
                            <input :id="'Income' + index" class="form-control" :name="'incomeFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{ __('BudgetPlanner.income') }}"
                                @input="calculateTotalIncome" />
                            <div class="input-group-append" v-if="index == 0">
                                <button class="btn btn-success btn-add" type="button"
                                    @click.prevent="addFieldIncome(index)"> + </button>
                            </div>
                            <div class="input-group-append" v-if="index != 0">
                                <button class="btn btn-danger btn-remove" type="button"
                                    @click.prevent="removeFieldIncome(index)"> - </button>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label class="h5" for="Expenses">{{ __('BudgetPlanner.TExpenses') }}
                            <span>@{{ formatNumber(expenses) }}</span></label>

                        <div v-for="(field, index) in expensesFields" :key="index" class="input-group mb-2">
                            <input :id="'Expenses' + index" class="form-control" :name="'expensesFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{ __('BudgetPlanner.Expenses') }} "
                                @input="calculateTotalExpenses" />

                            <div class="input-group-append" v-if="index == 0">
                                <button class="btn btn-success btn-add" type="button"
                                    @click.prevent="addFieldExpenses(index)"> + </button>
                            </div>
                            <div class="input-group-append" v-if="index != 0">
                                <button class="btn btn-danger btn-remove" type="button"
                                    @click.prevent="removeFieldExpenses(index)"> - </button>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">
                        <label class="h5" for="savings">{{ __('BudgetPlanner.TSavings') }}
                            <span>@{{ formatNumber(savings) }}</span></label>

                        <div v-for="(field, index) in savingsFields" :key="index" class="input-group mb-2">
                            <input :id="'Savings' + index" class="form-control" :name="'savingsFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{ __('BudgetPlanner.Savings') }}"
                                @input="calculateTotalSavings" />

                            <div class="input-group-append" v-if="index == 0">
                                <button class="btn btn-success btn-add" type="button"
                                    @click.prevent="addFieldSavings(index)"> + </button>
                            </div>
                            <div class="input-group-append" v-if="index != 0">
                                <button class="btn btn-danger btn-remove" type="button"
                                    @click.prevent="removeFieldSavings(index)"> - </button>
                            </div>

                        </div>


                    </div>
                </section>

                <section class="col-md-12 mt-3">
                    {{-- <img class="w-100" src=""> --}}
                </section>

                <section class="col-md-4 mt-3">
                    <h2 class="h4">{{ __('BudgetPlanner.BudgetProgress') }} </h2>

                    <p>{{ __('BudgetPlanner.TIncome') }} $ @{{ formatNumber(income) }}</p>
                    <p>{{ __('BudgetPlanner.TExpenses') }} $ @{{ formatNumber(expenses) }}</p>
                    <p>{{ __('BudgetPlanner.TSavingsGoal') }} $ @{{ formatNumber(savings) }}</p>
                    <h5>{{ __('BudgetPlanner.Remaining') }} $ @{{ formatNumber(remainingBudget) }}</h5>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" :aria-valuenow="budgetProgress" aria-valuemin="0"
                            aria-valuemax="100" :style="{ width: budgetProgress + '%' }">
                            <span class="sr-only">@{{ budgetProgress }}% Complete</span>
                        </div>
                    </div>

                    <form action="{{ route('pdf.budget-planner', ['locale' => collect(request()->segments())[0]], true) }}"
                        method="GET">
                        <input type="hidden" name="incomeFields" :value="JSON.stringify(incomeFields)">
                        <input type="hidden" name="expensesFields" :value="JSON.stringify(expensesFields)">
                        <input type="hidden" name="savingsFields" :value="JSON.stringify(savingsFields)">
                        <input type="hidden" name="TIncome" :value="formatNumber(income)">
                        <input type="hidden" name="TExpenses" :value="formatNumber(expenses)">
                        <input type="hidden" name="TSavingsGoal" :value="formatNumber(savings)">
                        <input type="hidden" name="Remaining" :value="formatNumber(remainingBudget)">
                        <button type="submit" class="btn btn-success my-2">{{ __('BudgetPlanner.DownloadPDF') }}</button>
                    </form>
                </section>

                <section class="col-md-4 mt-3">
                    <h2 class="h4">{{ __('BudgetPlanner.AFinancialTool') }}</h2>
                    <p>{{ __('BudgetPlanner.AFT-p-1') }}</p>
                    <p>{{ __('BudgetPlanner.AFT-p-2') }}</p>
                </section>

                <section class="col-md-4 mt-3">
                    <h2 class="h4">{{ __('BudgetPlanner.MYBP') }}</h2>
                    <p>{{ __('BudgetPlanner.MYBP-p1') }}</p>
                    <p>{{ __('BudgetPlanner.MYBP-p2') }} </p>
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
                income: '',
                expenses: '',
                savings: '',
                incomeFields: [{
                    value: ''
                }],
                expensesFields: [{
                    value: ''
                }],
                savingsFields: [{
                    value: ''
                }],
            },
            computed: {
                remainingBudget: function() {
                    return this.income - this.expenses - this.savings;
                },
                budgetProgress: function() {

                    const totalIncome = parseFloat(this.income) || 0;
                    const totalExpenses = parseFloat(this.expenses) || 0;
                    const totalSavings = parseFloat(this.savings) || 0;

                    // Calculate the budgetProgress, but make sure it's never less than 0 or greater than 100
                    let progress = (totalExpenses + totalSavings) / totalIncome * 100;

                    // Ensure progress is at least 0% and at most 100%
                    progress = Math.max(0, Math.min(progress, 100));

                    return progress;
                },
            },
            methods: {
                formatNumber(number) {
                    return Number(number).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    });
                },
                addFieldIncome(index) {
                    this.incomeFields.splice(index + 1, 0, {
                        value: ''
                    });
                },
                removeFieldIncome(index) {
                    this.incomeFields.splice(index, 1);
                    this.calculateTotalIncome();
                },
                addFieldExpenses(index) {
                    this.expensesFields.splice(index + 1, 0, {
                        value: ''
                    });
                },
                removeFieldExpenses(index) {
                    this.expensesFields.splice(index, 1);
                    this.calculateTotalExpenses();
                },
                addFieldSavings(index) {
                    this.savingsFields.splice(index + 1, 0, {
                        value: ''
                    });
                },
                removeFieldSavings(index) {
                    this.savingsFields.splice(index, 1);
                    this.calculateTotalSavings();
                },
                calculateTotalIncome() {
                    this.income = this.incomeFields.reduce((total, field) => {
                        return total + parseFloat(field.value || 0);
                    }, 0);
                },
                calculateTotalExpenses() {
                    this.expenses = this.expensesFields.reduce((total, field) => {
                        return total + parseFloat(field.value || 0);
                    }, 0);
                },
                calculateTotalSavings() {
                    this.savings = this.savingsFields.reduce((total, field) => {
                        return total + parseFloat(field.value || 0);
                    }, 0);
                },
            },
        });
    </script>
@endsection
