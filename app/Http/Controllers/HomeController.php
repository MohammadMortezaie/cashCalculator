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
    public function __construct()
    {
    }

    public function budgetPlanner(Request $request)
    {

        SEOTools::setTitle(__('BudgetPlanner.seoTitle'));
        SEOTools::setDescription(__('BudgetPlanner.seoDescription'));
        $prefixLang = $this->findPrefixLang($request->segment(1));

        OpenGraph::setTitle(__('BudgetPlanner.seoTitle'));
        OpenGraph::addProperty('locale', $prefixLang);
        OpenGraph::addProperty('locale:alternate', ['en-ca', 'en-us', 'es-es', 'fr-fr', 'it-it', 'de-de', 'pt-br', 'zh-cn', 'ko-kr', 'ru-ru']);
        // Alternate locales in Spanish, French, Italian, and German
        // Portuguese, Chinese, Korean, Russian


        return view('budgetPlanner');
    }
    public function moneyCalculator(Request $request)
    {
        SEOTools::setTitle(__('moneyCalculator.seoTitle'));
        SEOTools::setDescription(__('moneyCalculator.seoDescription'));
        $prefixLang = $this->findPrefixLang($request->segment(1));

        OpenGraph::setTitle(__('moneyCalculator.seoTitle'));
        OpenGraph::addProperty('locale', $prefixLang);
        OpenGraph::addProperty('locale:alternate', ['en-ca', 'en-us', 'es-es', 'fr-fr', 'it-it', 'de-de', 'pt-br', 'zh-cn', 'ko-kr', 'ru-ru']);



        return view('moneyCalculator');

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
