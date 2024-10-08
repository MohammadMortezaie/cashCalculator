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

    public function budget503020(Request $request){

        $this->validate($request,[
            'salary' => 'required',
            'T50' => 'required',
            'T30' => 'required',
            'T20' => 'required',
        ]);
        $data = $request->all();

        return view('pdf.503020',$data);
    }


    public function saveForRetirement(Request $request){

        $this->validate($request,[
            'results' => 'required',
        ]);

        $data = [
            'results' => json_decode($request->input('results') , true),
        ];

        return view('pdf.saveForRetirement',$data);
    }



    public function globalPDF(Request $request){

        $data = $request->all();
        return view('pdf.GlobalPDF',$data);
    }

}
