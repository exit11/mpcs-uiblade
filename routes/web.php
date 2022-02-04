<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Mpcs\Core\Facades\Core;



// Api Route
Route::group([
    'as'            => Core::getRouteNamePrefix('api'),
    'prefix'        => Core::getUrlPrefix('api'),
    'namespace'     => 'Exit11\UiBlade\Http\Controllers\Api',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->resource('menus', 'MenuController')->names('menus');
});


// Blade Route
Route::group([
    'as'            => Core::getRouteNamePrefix('ui'),
    'prefix'        => Core::getUrlPrefix('ui'),
    'namespace'     => 'Exit11\UiBlade\Http\Controllers\Blade',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->patch('menus/save_order', 'MenuController@saveOrder')->name('menus.save_order');
    $router->get('menus/list', 'MenuController@list')->name('menus.list');
    $router->resource('menus', 'MenuController')->names('menus');
});
