<?php

use Illuminate\Routing\Router;
use App\Models\PubCategory;
use App\Http\Resources\PubCategory as PubCategoryResource;
use App\Http\Resources\PubCategoryCollection;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'NewHomeController@index');

    $router->resource('network', 'NetDeviceController');
    $router->resource('category', 'PubCategoryController');
    $router->resource('operflow', 'PubOperflowController');
    $router->resource('property', 'PubPropertyController');
    $router->resource('contact', 'PubContactController');
    $router->resource('address', 'PubAddressController');
    $router->resource('cabinet', 'PubCabinetController');
    $router->resource('contract', 'PubContractController');
    $router->resource('manufacturer', 'PubManufacturerController');
    $router->resource('project', 'PubProjectController');

    // 分类单条数据接口 | 资源
    $router->get('api/category/{category}', function ($category) {
        return new PubCategoryResource(PubCategory::findOrFail($category)); // 单个资源
        // return PubCategoryResource::collection(PubCategory::all()); // 多个资源
    });

    // 分类多数据接口 | 资源集合
    $router->get('api/categories', function () {
        return new PubCategoryCollection(PubCategory::all());
    });
});
