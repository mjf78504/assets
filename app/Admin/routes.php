<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // 资产（网络）设备路由
    $router->resource('network', 'NetDeviceController');
    $router->post('network', 'NetDeviceController@store')->name('users.store');

    $router->resource('category', 'PubCategoryController');
    $router->resource('operflow', 'PubOperflowController');
    $router->resource('property', 'PubPropertyController');
    $router->resource('contact', 'PubContactController');
    $router->resource('address', 'PubAddressController');
    $router->resource('cabinet', 'PubCabinetController');
    $router->resource('contract', 'PubContractController');
});
