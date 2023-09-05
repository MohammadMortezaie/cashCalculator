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
        OpenGraph::addProperty('locale:alternate', ['en-ca', 'en-us', 'es-es', 'fr-fr', 'it-it', 'de-de']); // Alternate locales in Spanish, French, Italian, and German
        // Portuguese, Chinese, Korean, Russian


        return view('home');
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

        }
        return $prefix;
    }

}
