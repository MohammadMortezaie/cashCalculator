<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



$router->get('/', function () {
    return redirect('/en');
});


$router->group(['prefix' => '{locale}'], function () use ($router) {

    $router->get('/sitemap.xml', ['as' => 'sitemap', 'uses' => 'SitemapController@index']);



    $router->get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
    $router->get('/privacy-policy', ['as' => 'home.privacypolicy', 'uses' => 'HomeController@privacyPolicy']);


    // finance
    $router->get('/calculator', ['as' => 'home.calculator', 'uses' => 'HomeController@calculator']);
    $router->get('/budget-planner', ['as' => 'home.budgetPlanner', 'uses' => 'HomeController@budgetPlanner']);
    $router->get('/money-calculator', ['as' => 'home.moneyCalculator', 'uses' => 'HomeController@moneyCalculator']);
    $router->get('/50-30-20', ['as' => 'home.503020', 'uses' => 'HomeController@budget503020']);
    $router->get('/retirement-savings-calculator', ['as' => 'home.saveForRetirement', 'uses' => 'HomeController@saveForRetirement']);
    $router->get('/debt-payoff-calculator', ['as' => 'home.debtPayoff', 'uses' => 'HomeController@debtPayoff']);
    $router->get('/investment-calculator', ['as' => 'home.investmentCalculator', 'uses' => 'HomeController@investmentCalculator']);
    $router->get('/compound-interest-calculator', ['as' => 'home.compoundInterestCalculator', 'uses' => 'HomeController@compoundInterestCalculator']);
    $router->get('/percentage-calculator', ['as' => 'home.percentageCalculator', 'uses' => 'HomeController@percentageCalculator']);
    $router->get('/percent-difference-calculator', ['as' => 'home.percentDiffCalculator', 'uses' => 'HomeController@percentDiffCalculator']);
    $router->get('/percentage-change-calculator', ['as' => 'home.percentageChangeCalculator', 'uses' => 'HomeController@percentageChangeCalculator']);

    // health
    $router->get('/bmi', ['as' => 'home.bmi', 'uses' => 'HomeController@bmi']);

    //pdf
    $router->get('/pdf-free', ['as' => 'pdf.globalPDF', 'uses' => 'PdfController@globalPDF']);
    $router->get('/pdf-budget-planner', ['as' => 'pdf.budget-planner', 'uses' => 'PdfController@budgetPlanner']);
    $router->get('/pdf-money-calculator', ['as' => 'pdf.money-calculator', 'uses' => 'PdfController@moneyCalculator']);
    $router->get('/pdf-50-30-20', ['as' => 'pdf.budget503020', 'uses' => 'PdfController@budget503020']);
    $router->get('/pdf-retirement-savings-calculator', ['as' => 'pdf.saveForRetirement', 'uses' => 'PdfController@saveForRetirement']);


});

