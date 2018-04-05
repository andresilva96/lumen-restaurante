<?php

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

$router->group(['prefix' => 'api/v1', 'middleware' => ['cors']], function () use ($router) {
    $router->post('/auth/login', 'AuthController@login');
    $router->post('/auth/refresh_token', function () {
        try {
            $guard = Auth::guard();
            return response()->json(['token' => $guard->refresh()]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $exception) {
            return response()->json(['error' => 'Cound not refresh token.'], 400);
        }
    });

    Route::group(['middleware' => 'auth'], function ($router) {
        $router->get('restaurant', 'RestaurantController@index');
        $router->get('restaurant/{id}', 'RestaurantController@show');
        $router->post('restaurant', 'RestaurantController@insert');
        $router->put('restaurant/{id}', 'RestaurantController@update');
        $router->delete('restaurant/{id}', 'RestaurantController@delete');
    });
});