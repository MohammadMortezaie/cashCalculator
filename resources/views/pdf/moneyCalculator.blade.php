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
        }

        .section ul {
            list-style: none;
            padding: 0;
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
            <h4>{{ __('moneyCalculator.Bills') }}</h4>

            <ul>
                @foreach ($currency['cash'] as $key => $item)
                    @if ($item)
                        <li> {{ $item }} <span> × </span> {{ $key }} {{ __('moneyCalculator.Bills') }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h4>{{ __('moneyCalculator.Coins') }}</h4>
            <ul>

                @foreach ($currency['coins'] as $key => $item)
                    @if ($item)
                        <li> {{ $item }} <span> × </span> {{ $key }} {{ __('moneyCalculator.Bills') }}
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
        <div class="section">
            <hr>
            <h3><span class="total-amount">{{ __('moneyCalculator.TotalAmount') }}</span> {{ $total }}
                {{ $currency['name'] }}</h3>
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
