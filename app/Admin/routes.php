<?php

use Illuminate\Routing\Router;
use App\Models\PubCategory;
use App\Http\Resources\PubCategory as PubCategoryResource;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('network', 'NetDeviceController');
    $router->resource('category', 'PubCategoryController');
    $router->resource('operflow', 'PubOperflowController');
    $router->resource('property', 'PubPropertyController');
    $router->resource('contact', 'PubContactController');
    $router->resource('address', 'PubAddressController');
    $router->resource('cabinet', 'PubCabinetController');
    $router->resource('contract', 'PubContractController');
    $router->resource('manufacturer', 'PubManufacturerController');

    // 接口
    $router->get('api/category', function () {
        return new PubCategoryResource(PubCategory::all());
    });
});
