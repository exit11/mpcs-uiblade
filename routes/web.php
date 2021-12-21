<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Mpcs\Core\Facades\Core;


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
