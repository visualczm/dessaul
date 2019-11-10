<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('dessaul/navbar', NavbarController::class);//首页Navbar
    $router->resource('dessaul/category', NavCategoryController::class);//首页Navbar
    $router->resource('dessaul/settings', SettingsController::class);
    $router->redirect('dessaul/settings','settings/1/edit');

});


