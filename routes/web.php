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

$router->get('/budget-planner', function () {
    return redirect('/en/budget-planner');
});
$router->get('/money-calculator', function () {
    return redirect('/en/money-calculator');
});
$router->get('/50-30-20', function () {
    return redirect('/en/50-30-20');
});



$router->group(['prefix' => '{locale}'], function () use ($router) {

    $router->group(['prefix' => 'pdf'], function () use ($router) {

        $router->get('/budget-planner', [ 'as' => 'pdf.budget-planner', 'uses' => 'PdfController@budgetPlanner']);
        $router->get('/money-calculator', [ 'as' => 'pdf.money-calculator', 'uses' => 'PdfController@moneyCalculator']);
        $router->get('/50-30-20', [ 'as' => 'pdf.budget503020', 'uses' => 'PdfController@budget503020']);

    });

    $router->get('/', [ 'as' => 'home', 'uses' => 'HomeController@home']);
    $router->get('/privacy-policy', [ 'as' => 'home.privacypolicy', 'uses' => 'HomeController@privacyPolicy']);

    $router->get('/budget-planner', [ 'as' => 'home.budgetPlanner', 'uses' => 'HomeController@budgetPlanner'] );
    $router->get('/money-calculator',  [ 'as' => 'home.moneyCalculator', 'uses' => 'HomeController@moneyCalculator']);
    $router->get('/50-30-20', [ 'as' => 'home.503020', 'uses' => 'HomeController@budget503020'] );

});
