<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CashCalculator.net</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            background: black;
            color: whitesmoke;
            padding: 20px;
            font-size: 20px;
            text-align: center;
        }

        .content {
            margin: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .section ul {
            list-style: none;
            padding: 0;
            margin-top: 0;
        }

        .section li {
            font-size: 16px;
        }

        .section hr {
            border: 1px solid #ccc;
        }

        .total-amount {
            font-size: 25px;
        }
    </style>

    <!-- html2pdf CDN link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body id="element-to-convert">
    <div class="header">
        <h1>CashCalculator.net</h1>
    </div>
    <div class="content">
        <div class="section">
            <h4>{{ __('BudgetPlanner.income') }}</h4>
            <ul>
                @foreach ($incomeFields as $item)
                    <li>{{ __('BudgetPlanner.income') }}: {{ number_format(floatval($item['value']), 2) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h4>{{ __('BudgetPlanner.Expenses') }}</h4>
            <ul>
                @foreach ($expensesFields as $item)
                    <li>{{ __('BudgetPlanner.Expenses') }}: {{ number_format(floatval($item['value']), 2) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h4>{{ __('BudgetPlanner.Savings') }}</h4>
            <ul>
                @foreach ($savingsFields as $item)
                    <li>{{ __('BudgetPlanner.Savings') }}: {{ number_format(floatval($item['value']), 2) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <hr>
            <h3>{{ __('BudgetPlanner.TIncome') }} $ {{ $TIncome }}</h3>
            <h3>{{ __('BudgetPlanner.TExpenses') }} $ {{ $TExpenses }}</h3>
            <h3>{{ __('BudgetPlanner.TSavingsGoal') }} $ {{ $TSavingsGoal }}</h3>
            <h2>{{ __('BudgetPlanner.Remaining') }} <br> $ {{ $Remaining }}</h2>

        </div>
    </div>
    <script>
        // Choose the element that your content will be rendered to.
        const element = document.getElementById('element-to-convert');
        // Choose the element and save the PDF for your user.
        html2pdf().from(element).save();
    </script>
</body>

</html>
