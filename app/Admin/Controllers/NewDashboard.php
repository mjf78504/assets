<?php

namespace App\Admin\Controllers;

use Encore\Admin\Admin;

use App\Models\NetDevice;

class NewDashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
        return view('admin::dashboard.title');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function environment()
    {
        $envs = [
            ['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],
            ['name' => 'Laravel version',   'value' => app()->version()],
            ['name' => 'CGI',               'value' => php_sapi_name()],
            ['name' => 'Uname',             'value' => php_uname()],
            ['name' => 'Server',            'value' => array_get($_SERVER, 'SERVER_SOFTWARE')],

            ['name' => 'Cache driver',      'value' => config('cache.default')],
            ['name' => 'Session driver',    'value' => config('session.driver')],
            ['name' => 'Queue driver',      'value' => config('queue.default')],

            ['name' => 'Timezone',          'value' => config('app.timezone')],
            ['name' => 'Locale',            'value' => config('app.locale')],
            ['name' => 'Env',               'value' => config('app.env')],
            ['name' => 'URL',               'value' => config('app.url')],
        ];

        return view('admin::dashboard.environment', compact('envs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function extensions()
    {
        $extensions = [
            'helpers' => [
                'name' => 'laravel-admin-ext/helpers',
                'link' => 'https://github.com/laravel-admin-extensions/helpers',
                'icon' => 'gears',
            ],
            'log-viewer' => [
                'name' => 'laravel-admin-ext/log-viewer',
                'link' => 'https://github.com/laravel-admin-extensions/log-viewer',
                'icon' => 'database',
            ],
            'backup' => [
                'name' => 'laravel-admin-ext/backup',
                'link' => 'https://github.com/laravel-admin-extensions/backup',
                'icon' => 'copy',
            ],
            'config' => [
                'name' => 'laravel-admin-ext/config',
                'link' => 'https://github.com/laravel-admin-extensions/config',
                'icon' => 'toggle-on',
            ],
            'api-tester' => [
                'name' => 'laravel-admin-ext/api-tester',
                'link' => 'https://github.com/laravel-admin-extensions/api-tester',
                'icon' => 'sliders',
            ],
            'media-manager' => [
                'name' => 'laravel-admin-ext/media-manager',
                'link' => 'https://github.com/laravel-admin-extensions/media-manager',
                'icon' => 'file',
            ],
            'scheduling' => [
                'name' => 'laravel-admin-ext/scheduling',
                'link' => 'https://github.com/laravel-admin-extensions/scheduling',
                'icon' => 'clock-o',
            ],
            'reporter' => [
                'name' => 'laravel-admin-ext/reporter',
                'link' => 'https://github.com/laravel-admin-extensions/reporter',
                'icon' => 'bug',
            ],
            'redis-manager' => [
                'name' => 'laravel-admin-ext/redis-manager',
                'link' => 'https://github.com/laravel-admin-extensions/redis-manager',
                'icon' => 'flask',
            ],
        ];

        foreach ($extensions as &$extension) {
            $name = explode('/', $extension['name']);
            $extension['installed'] = array_key_exists(end($name), Admin::$extensions);
        }

        return view('admin::dashboard.extensions', compact('extensions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function dependencies($category, $title)
    {
        // $json = file_get_contents(base_path('composer.json'));

        // $dependencies = json_decode($json, true)['require'];

        $system = NetDevice::where('category', $category)->count(); // 分組
        $local1 = NetDevice::where('category', $category)->where('location', 1)->count(); // 总行生产
        $local2 = NetDevice::where('category', $category)->where('location', 2)->count(); // 同城生产
        $local3 = NetDevice::where('category', $category)->where('location', 3)->count(); // 总行测试
        $local4 = NetDevice::where('category', $category)->where('location', 4)->count(); // 总行库房

        $status1 = NetDevice::where('category', $category)->where('status', 39)->count();        
        $status2 = NetDevice::where('category', $category)->where('status', 40)->count();
        $product = NetDevice::where('category', $category)->where('status', 40)->count();
        $dependencies = array_add([], '设备总数', $system);
        $dependencies = array_add($dependencies, '总行生产机房', $local1);
        $dependencies = array_add($dependencies, '同城生产机房', $local2);
        $dependencies = array_add($dependencies, '总行测试机房', $local3);
        $dependencies = array_add($dependencies, '总行设备库房', $local4);
        $dependencies = array_add($dependencies, '启动', $status1);
        $dependencies = array_add($dependencies, '停止', $status2);

        if ($category == 16) {
            $newcategory = '<a href="network?&_scope_=b">'.$title.'</a>';
        }else if ($category == 17) {
            $newcategory = '<a href="network?&_scope_=a">'.$title.'</a>';
        }else if ($category == 18) {
            $newcategory = '<a href="network?&_scope_=c">'.$title.'</a>';
        }else if ($category == 19) {
            $newcategory = '<a href="network?&_scope_=d">'.$title.'</a>';
        }else if ($category = 20){
            $newcategory = '<a href="network?&_scope_=e">'.$title.'</a>';
        }

        $data = [
            'title' => $newcategory,
            'dependencies' => $dependencies
        ];


        return view('admin::dashboard.dependencies', $data);
    }
    /**
     * 读取饼图
     */
    public static function pie()
    {
        return view('charts.pie');
    }

    /**
     * 读取柱状图
     */
    public static function bar()
    {
        return view('charts.bar');
    }
}
