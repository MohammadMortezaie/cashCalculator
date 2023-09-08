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
