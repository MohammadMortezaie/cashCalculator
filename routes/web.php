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

$router->get('/', function () use ($router) {
    return redirect('/en');
});

$router->group(['prefix' => '{locale}'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version() . ' -  - mohammad';
    });

    $router->get('/budget-planner', 'HomeController@budgetPlanner');
    $router->get('/money-calculator', 'HomeController@moneyCalculator');

});
