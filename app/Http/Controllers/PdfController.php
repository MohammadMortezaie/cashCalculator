<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function budgetPlanner(Request $request)
    {
        $this->validate($request,[
            'incomeFields' => 'required',
            'expensesFields' => 'required',
            'savingsFields' => 'required',
            'TIncome' => 'required',
            'TExpenses' => 'required',
            'TSavingsGoal' => 'required',
            'Remaining' => 'required',
        ]);

        $data = [
            'TIncome' => $request->input('TIncome'),
            'TExpenses' => $request->input('TExpenses'),
            'TSavingsGoal' => $request->input('TSavingsGoal'),
            'Remaining' => $request->input('Remaining'),
            'incomeFields' => json_decode($request->input('incomeFields') , true),
            'expensesFields' => json_decode($request->input('expensesFields') , true),
            'savingsFields' => json_decode($request->input('savingsFields') , true),
        ];
// dd($data);
        return view('pdf.budgetPlanner', $data);
    }

    public function moneyCalculator(Request $request)
    {
        $this->validate($request,[
            'currencyData' => 'required',
            'total' => 'required',
        ]);

        $data = [
            'total' => $request->input('total'),
            'currency' => json_decode($request->input('currencyData') , true),
        ];

        return view('pdf.moneyCalculator',$data);

    }


}
