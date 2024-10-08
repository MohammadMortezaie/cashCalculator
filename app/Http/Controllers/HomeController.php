<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private function setSeoAndOpenGraph($titleKey, $descriptionKey, $view)
    {
        $request = request();
        $prefixLang = $this->findPrefixLang($request->segment(1));
        $localeKeys = ['en-ca', 'en-us', 'es-es', 'fr-fr', 'it-it', 'de-de', 'pt-br', 'zh-cn', 'ko-kr', 'ru-ru'];

        SEOTools::setTitle(__($titleKey));
        SEOTools::setDescription(__($descriptionKey));
        OpenGraph::setTitle(__($titleKey));
        OpenGraph::addProperty('locale', $prefixLang);
        OpenGraph::addProperty('locale:alternate', $localeKeys);

        return view($view);
    }


    public function home(Request $request)
    {
        return $this->setSeoAndOpenGraph('home.seoTitle', 'home.seoDescription', 'home');
    }
    public function calculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('free calculator', 'free calculator', 'finance.calculator');
    }
    public function budgetPlanner(Request $request)
    {
        return $this->setSeoAndOpenGraph('BudgetPlanner.seoTitle', 'BudgetPlanner.seoDescription', 'finance.budgetPlanner');
    }
    public function moneyCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('moneyCalculator.seoTitle', 'moneyCalculator.seoDescription', 'finance.moneyCalculator');
    }

    public function budget503020(Request $request)
    {
        return $this->setSeoAndOpenGraph('503020.seoTitle', '503020.top-p-1', 'finance.503020');
    }
    public function saveForRetirement(Request $request)
    {
        return $this->setSeoAndOpenGraph('saveForRetirement.seoTitle', 'saveForRetirement.seoDescription', 'finance.saveForRetirement');
    }

    public function debtPayoff(Request $request)
    {
        return $this->setSeoAndOpenGraph('debtPayoff.seoTitle', 'debtPayoff.seoDescription', 'finance.debtPayoff');
    }

    public function investmentCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('investmentCalculator.seoTitle', 'investmentCalculator.seoDescription', 'finance.investmentCalculator');
    }

    public function compoundInterestCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('compound.seoTitle', 'compound.seoDescription', 'finance.compoundInterestCalculator');
    }
    public function percentageCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('percentageCalculator.seoTitle', 'percentageCalculator.seoDescription', 'finance.percentageCalculator');
    }

    public function percentDiffCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('percentDiffCalculator.seoTitle', 'percentDiffCalculator.seoDescription', 'finance.percentDiffCalculator');
    }
    public function percentageChangeCalculator(Request $request)
    {
        return $this->setSeoAndOpenGraph('percentageChangeCalculator.seoTitle', 'percentageChangeCalculator.seoDescription', 'finance.percentageChangeCalculator');
    }



    public function bmi(Request $request)
    {
        return $this->setSeoAndOpenGraph('bmi.seoTitle', 'bmi.seoDescription', 'health.bmi');
    }





    public function privacyPolicy(Request $request)
    {
        return view('privacyPolicy');
    }
    public function findPrefixLang($lang)
    {
        $prefix = 'en-us';
        switch ($lang) {
            case 'es':
                $prefix = 'es-es';
                break;
            case 'fr':
                $prefix = 'fr-fr';
                break;
            case 'it':
                $prefix = 'it-it';
                break;
            case 'de':
                $prefix = 'de-de';
                break;
            case 'pt-br':
                $prefix = 'pt-br';
                break;
            case 'zh-cn':
                $prefix = 'zh-cn';
                break;
            case 'ko':
                $prefix = 'ko-kr';
                break;
            case 'ru':
                $prefix = 'ru-ru';
                break;
        }
        return $prefix;
    }

}
