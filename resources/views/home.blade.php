@extends('main')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Calculate your mortgage, manage your personal budget, and track your income, expenses, and savings goals with our comprehensive Mortgage Calculator and Budget Planner tool. It's free and easy to use. Take control of your finances and achieve your financial goals with ease.">
    <title>Mortgage Calculator & Budget Planner - Financial Tool</title>

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
                </section>

                <section class="col-md-12">
                    <hr>
                    <div class="col-md-4">
                        <label for="Income">{{__('BudgetPlanner.TIncome')}} <span>@{{ formatNumber(income) }}</span></label>

                        <div v-for="(field, index) in incomeFields" :key="index" class="input-group"
                            style="margin-bottom: 5px">
                            <input :id="'Income' + index" class="form-control" :name="'incomeFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{__('BudgetPlanner.income')}}" @input="calculateTotalIncome" />
                            <span class="input-group-btn" v-if="index == 0">
                                <button @click.prevent="addFieldIncome(index)" class="btn btn-success btn-add"
                                    type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                            <span class="input-group-btn" v-if="index != 0">
                                <button @click.prevent="removeFieldIncome(index)" class="btn btn-danger btn-remove"
                                    type="button">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                        </div>



                    </div>

                    <div class="col-md-4">
                        <label for="Expenses">{{__('BudgetPlanner.TExpenses')}}<span>@{{ formatNumber(expenses) }}</span></label>

                        <div v-for="(field, index) in expensesFields" :key="index" class="input-group"
                            style="margin-bottom: 5px">
                            <input :id="'Expenses' + index" class="form-control" :name="'expensesFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{__('BudgetPlanner.Expenses')}} "
                                @input="calculateTotalExpenses" />
                            <span class="input-group-btn" v-if="index == 0">
                                <button @click.prevent="addFieldExpenses(index)" class="btn btn-success btn-add"
                                    type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                            <span class="input-group-btn" v-if="index != 0">
                                <button @click.prevent="removeFieldExpenses(index)" class="btn btn-danger btn-remove"
                                    type="button">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <label for="savings">{{__('BudgetPlanner.TSavings')}} <span>@{{ formatNumber(savings) }}</span></label>

                        <div v-for="(field, index) in savingsFields" :key="index" class="input-group"
                            style="margin-bottom: 5px">
                            <input :id="'Savings' + index" class="form-control" :name="'savingsFields[' + index + ']'"
                                type="number" v-model="field.value" placeholder="{{__('BudgetPlanner.Savings')}}"
                                @input="calculateTotalSavings" />
                            <span class="input-group-btn" v-if="index == 0">
                                <button @click.prevent="addFieldSavings(index)" class="btn btn-success btn-add"
                                    type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                            <span class="input-group-btn" v-if="index != 0">
                                <button @click.prevent="removeFieldSavings(index)" class="btn btn-danger btn-remove"
                                    type="button">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                            </span>
                        </div>


                    </div>
                </section>

                <section class="col-md-12" style="margin-top: 20px">
                    <img style="width: 100%"
                        src="https://www.gourmetads.com/wp-content/uploads/2019/02/970x250-starbucks-nitro.jpg">
                </section>

                <section class="col-md-4" style="margin-top: 40px">
                    <h2 class="h3">{{__('BudgetPlanner.BudgetProgress')}} </h2>

                    <p>{{__('BudgetPlanner.TIncome')}} $ @{{ formatNumber(income) }}</p>
                    <p>{{__('BudgetPlanner.TExpenses')}} $ @{{ formatNumber(expenses) }}</p>
                    <p>{{__('BudgetPlanner.TSavingsGoal')}}  $ @{{ formatNumber(savings) }}</p>
                    <h4>{{__('BudgetPlanner.Remaining')}} $ @{{ formatNumber(remainingBudget) }}</h4>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" :aria-valuenow="budgetProgress" aria-valuemin="0"
                            aria-valuemax="100" :style="{ width: budgetProgress + '%' }">
                            <span class="sr-only">@{{ budgetProgress }}% Complete</span>
                        </div>
                    </div>

                    <button class="btn btn-success">{{__('BudgetPlanner.DownloadPDF')}}</button>
                </section>

                <section class="col-md-4" style="margin-top: 40px">
                    <h2 class="h3">{{__('BudgetPlanner.AFinancialTool')}}</h2>
                    <p>{{__('BudgetPlanner.AFT-p-1')}}</p>
                    <p>{{__('BudgetPlanner.AFT-p-2')}}</p>
                </section>

                <section class="col-md-4" style="margin-top: 40px">
                    <h2 class="h3">{{__('BudgetPlanner.MYBP')}}</h2>
                    <p>{{__('BudgetPlanner.MYBP-p1')}}</p>
                    <p>{{__('BudgetPlanner.MYBP-p2')}} </p>

                    <p>{{__('BudgetPlanner.TIncome')}} $ @{{ formatNumber(income) }}</p>
                    <p>{{__('BudgetPlanner.TExpenses')}} $ @{{ formatNumber(expenses) }}</p>
                    <p>{{__('BudgetPlanner.TSavingsGoal')}}  $ @{{ formatNumber(savings) }}</p>
                    <p>{{__('BudgetPlanner.Remaining')}} $ @{{ formatNumber(remainingBudget) }}</p>

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
