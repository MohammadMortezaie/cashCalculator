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
            @foreach ($results as $key => $result)
                @if ($key === 0)
                    <h4>
                        {{ __('saveForRetirement.monthly_savings_plan') }}
                    </h4>
                    <ul>
                        <li><strong>{{ __('saveForRetirement.additional_amount_needed') }}</strong>
                            {{ $result['amount'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                            {{ $result['principal'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                            {{ $result['interest'] }}
                        </li>
                    </ul>
                @endif
                @if ($key === 1)
                    <h4>
                        {{ __('saveForRetirement.yearly_savings_plan') }}
                    </h4>
                    <ul>
                        <li><strong>{{ __('saveForRetirement.amount_to_save_yearly') }}</strong>
                            ${{ $result['amount'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                            ${{ $result['principal'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                            ${{ $result['interest'] }}
                        </li>
                    </ul>
                @endif

                @if ($key === 2)
                    <h4>
                        {{ __('saveForRetirement.lump_sum_savings_plan') }}
                    </h4>
                    <ul>
                        <li><strong>{{ __('saveForRetirement.additional_amount_needed') }}</strong>
                            ${{ $result['amount'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_principal') }}</strong>
                            ${{ $result['principal'] }}
                        </li>
                        <li><strong>{{ __('saveForRetirement.total_interest') }}</strong>
                            ${{ $result['interest'] }}
                        </li>
                    </ul>
                @endif
            @endforeach



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
