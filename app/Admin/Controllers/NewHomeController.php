<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Controllers\NewDashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class NewHomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('柳州银行')
            ->description(' ')
            ->row(NewDashboard::title())
            ->row(NewDashboard::charts())
            ->row(function (Row $row) {

                $row->column(3, function (Column $column) {
                    $column->append(NewDashboard::dependencies(16, '系统设备'));
                });

                $row->column(3, function (Column $column) {
                    $column->append(NewDashboard::dependencies(17, '网络设备'));
                });

                $row->column(3, function (Column $column) {
                    $column->append(NewDashboard::dependencies(18, '安全设备'));
                });

                $row->column(3, function (Column $column) {
                    $column->append(NewDashboard::dependencies(19, '办公设备'));
                });                

            });
    }

    /** 接口调用
     * public function test()
     * {
     * $task = ['abc' => '来吧哥哥在此，休得造次'];
     * // \Db::info('---------：' . $task['abc']);
     * return $this->response->arary($task);
     * }
     */
}
