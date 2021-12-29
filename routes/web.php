<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Mpcs\Core\Facades\Core;



// Api Route
Route::group([
    'as'          => Core::getConfigString('route_name_prefix'),
    'prefix'        => Core::getConfig('url_prefix'),
    'namespace'     => 'Exit11\UiBlade\Http\Controllers\Api',
    'middleware'    => Core::getConfig('route.middleware'),
], function (Router $router) {
    $router->resource('menus', 'MenuController')->names('menus')->except(['destroy']);
});


// Blade Route
Route::group([
    'as'          => Core::getConfigString('ui_route_name_prefix'),
    'prefix'        => Core::getConfig('ui_url_prefix'),
    'namespace'     => 'Exit11\UiBlade\Http\Controllers\Blade',
    'middleware'    => config('mpcs.route.middleware'),
], function (Router $router) {
    $router->patch('menus/save_order', 'MenuController@saveOrder')->name('menus.save_order');
    $router->get('menus/list', 'MenuController@list')->name('menus.list');
    $router->resource('menus', 'MenuController')->names('menus')->except(['destroy']);
});

// Official
Route::group([
    'as'            => 'uiblade',
    'prefix'        => Core::getConfig('ui_url_prefix', 'mpcsuiblade'),
    'namespace'     => '\App\Http\Controllers\Web',
    'middleware'    => "web",
], function (Router $router) {

    // home
    $router->get('/', [
        'uses' => 'MainController@index'
    ])->name('home');
});
