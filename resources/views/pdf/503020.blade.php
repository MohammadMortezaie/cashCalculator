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
            <label class="h5" for="Income">{{ __('503020.salaryIncome') }} :
                <span>{{ $salary }}</span></label>


            <div>
                <p> {{ __('503020.top-p-3-1') }} ${{ $salary }} {{ __('503020.top-p-3-1') }} </p>
                <ul>
                    <li style="margin-top: 15px">
                        50% of {{ $salary }} {{ __('503020.necessities') }}<br>
                        ( {{ $salary }} × 50) / 100 = $<strong>{{ $T50 }} </strong>
                    </li>
                    <li style="margin-top: 15px">
                        30% of $ {{ $salary }} {{ __('503020.wants') }} <br>
                        ( {{ $salary }} × 30) / 100 = $<strong>{{ $T30 }} </strong>
                    </li>
                    <li style="margin-top: 15px">
                        20% of $ {{ $salary }} {{ __('503020.savings') }} <br>
                        ( {{ $salary }} × 20) / 100 = $<strong>{{ $T20 }} </strong>
                    </li>
                </ul>

            </div>

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
