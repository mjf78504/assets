<?php

use Illuminate\Routing\Router;
use App\Models\PubCategory;
use App\Http\Resources\PubCategory as PubCategoryResource;
use App\Http\Resources\PubCategoryCollection;
use App\Models\NetDevice;
use App\Http\Controllers\Api\ChartController;

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

    // 分类单条数据接口 | 通過资源訪問
/*    $router->get('api/category/{category}', function ($category) {
        return new PubCategoryResource(PubCategory::findOrFail($category)); // 单个资源
        // return PubCategoryResource::collection(PubCategory::all()); // 多个资源
    });*/

    // 分类多数据接口 | 资源集合
    $router->get('api/categories', function () {
        return new PubCategoryCollection(PubCategory::all());
    });

    /**
     * 通過控制器訪問資源
     */
    // 表格数据：状态和分组
    $router->get('api/chartsinfo', 'ChartController@chartsinfo');

    // 表格数据：地域和时间
    $router->get('api/chartsinfo1', 'ChartController@chartsinfo1');

});


