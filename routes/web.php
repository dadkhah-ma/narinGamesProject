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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {

        $router->post('/get-code', [
            'uses' => 'AuthController@getAuthCode',
            'middleware' => [
                'App\Http\Middleware\AuthGetCodeValidationMiddleware',
                'App\Http\Middleware\AuthMobileNumberMiddleware',
            ],
        ]);

        $router->post('/login', [
            'uses' => 'AuthController@login',
            'middleware' => [
                'App\Http\Middleware\AuthLoginValidationMiddleware',
                'App\Http\Middleware\AuthLoginCheckPasswordMiddleware',
            ],
        ]);
    });

    $router->group(['prefix' => 'games', 'middleware' => 'auth'], function () use ($router) {

        $router->get('/', [
            'uses' => 'GameController@view',
            'middleware' => [
                'App\Http\Middleware\GameViewValidationMiddleware',
                'App\Http\Middleware\GameViewCheckIdMiddleware',
            ],
        ]);

        $router->post('/create', [
            'uses' => 'GameController@create',
            'middleware' => [
                'App\Http\Middleware\GameCreateValidationMiddleware',
                'App\Http\Middleware\GameViewCheckIdMiddleware',
            ],
        ]);
    });
});

