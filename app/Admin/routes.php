<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('purchasings', PurchasingController::class);

    $router->resource('manajemen-penjualans', ManajemenPenjualanController::class);

    $router->resource('manajemen-persediaans', ManajemenPersediaanControllers::class);
    $router->resource('coba', CobaController::class);

});
