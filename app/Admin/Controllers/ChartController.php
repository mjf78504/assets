<?php

namespace App\Admin\Controllers;

use App\Models\NetDevice;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ChartController extends Controller
{
    use HasResourceActions;


    /**
     * 返回接口單條數據
     */
    public function chartsinfo() {
        \Log::info('----调用single函数开始-----');

        $category1 = NetDevice::where('category', 16)->count(); // 系統
        $category2 = NetDevice::where('category', 17)->count(); // 網絡
        $category3 = NetDevice::where('category', 18)->count(); // 安全
        $category4 = NetDevice::where('category', 19)->count(); // 辦公
        $category5 = NetDevice::where('category', 20)->count(); // 其他

        $status1 = NetDevice::where('status', 39)->count(); // 运行
        $status2 = NetDevice::where('status', 40)->count(); // 停机
        $status3 = NetDevice::where('status', 56)->count(); // 未知

        $data['category1'] =$category1;
        $data['category2'] =$category2;
        $data['category3'] =$category3;
        $data['category4'] =$category4;
        $data['category5'] =$category5;

        $data['status1'] =$status1;
        $data['status2'] =$status2;
        $data['status3'] =$status3;

        return $data;

    }

    /**
     * 每个月各个地域的设备新增数量
     */
    public function chartsinfo1() {
        $local1 = NetDevice::where('location', 1)->count(); // 总行生产
        $local2 = NetDevice::where('location', 2)->count(); // 同城生产
        $local3 = NetDevice::where('location', 3)->count(); // 总行测试
        $local4 = NetDevice::where('location', 4)->count(); // 总行库房

        $infos = NetDevice::all();
        // $infos->toArray();

        $month =[
            'aa'=>[],   // 总行生产
            'bb'=>[],   // 同城生产
            'cc'=>[],   // 总行测试
            'ee'=>[],   // 总行库房
        ];

        $i = ['a01','a02','a03','a04','a05','a06','a07','a08','a09','a10','a11','a12']; // 代表月份
        foreach($infos as $info) {
            if ($info->location == 1) {
                $month1 = 'a' . date('m', strtotime($info->created_at));
                if (array_has($month, 'aa.'.$month1)) {
                $month['aa'][$month1] += 1;
                }else {
                    $month['aa'][$month1] = 1;
                }
                // 没有的月份设置为0
                foreach ($i as $j) {
                    if (!array_has($month, 'aa.'.$j)) {
                        $month['aa'][$j] =0;
                    }
                }
            }else if ($info->location == 2) {
                $month1 = 'a' . date('m', strtotime($info->created_at));
                if (array_has($month, 'bb.'.$month1)) {
                    $month['bb'][$month1] += 1;
                }else {
                    $month['bb'][$month1] = 1;
                }
                // 没有的月份设置为0
                foreach ($i as $j) {
                    if (!array_has($month, 'bb.'.$j)) {
                        $month['bb'][$j] =0;
                    }
                }
            }else if ($info->location == 3) {
                $month1 = 'a' . date('m', strtotime($info->created_at));
                if (array_has($month, 'cc.'.$month1)) {
                    $month['cc'][$month1] += 1;
                }else {
                    $month['cc'][$month1] = 1;
                }
                // 没有的月份设置为0
                foreach ($i as $j) {
                    if (!array_has($month, 'cc.'.$j)) {
                        $month['cc'][$j] =0;
                    }
                }
            }else if ($info->location == 4) {
                $month1 = 'a' . date('m', strtotime($info->created_at));
                if (array_has($month, 'ee.'.$month1)) {
                    $month['ee'][$month1] += 1;
                }else {
                    $month['ee'][$month1] = 1;
                }
                // 没有的月份设置为0
                foreach ($i as $j) {
                    if (!array_has($month, 'ee.'.$j)) {
                        $month['ee'][$j] =0;
                    }
                }
            }
        };

        $month = array_sort_recursive($month);  // 递归地对数组进行排序
        \Log::info($month);
        return $month;
    }

    /**
     * 回调函数
     */
    public function change($v) {
        return substr((string)$v->created_at, 0,10);
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NetDevice);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->maintaindate('Maintaindate');
        $grid->updatetime('Updatetime');
        $grid->category('Category');
        $grid->SN('SN');
        $grid->name('Name');
        $grid->type('Type');
        $grid->devicetype('Devicetype');
        $grid->producer('Producer');
        $grid->supplier('Supplier');
        $grid->contractprice('Contractprice');
        $grid->contractNo('ContractNo');
        $grid->status('Status');
        $grid->changestatus('Changestatus');
        $grid->location('Location');
        $grid->description('Description');
        $grid->manageIP('ManageIP');
        $grid->appIP('AppIP');
        $grid->hostname('Hostname');
        $grid->project('Project');
        $grid->level('Level');
        $grid->statusofrecord('Statusofrecord');
        $grid->extend1('Extend1');
        $grid->extend2('Extend2');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(NetDevice::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->maintaindate('Maintaindate');
        $show->updatetime('Updatetime');
        $show->category('Category');
        $show->SN('SN');
        $show->name('Name');
        $show->type('Type');
        $show->devicetype('Devicetype');
        $show->producer('Producer');
        $show->supplier('Supplier');
        $show->contractprice('Contractprice');
        $show->contractNo('ContractNo');
        $show->status('Status');
        $show->changestatus('Changestatus');
        $show->location('Location');
        $show->description('Description');
        $show->manageIP('ManageIP');
        $show->appIP('AppIP');
        $show->hostname('Hostname');
        $show->project('Project');
        $show->level('Level');
        $show->statusofrecord('Statusofrecord');
        $show->extend1('Extend1');
        $show->extend2('Extend2');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NetDevice);

        $form->date('maintaindate', 'Maintaindate')->default(date('Y-m-d'));
        $form->datetime('updatetime', 'Updatetime')->default(date('Y-m-d H:i:s'));
        $form->text('category', 'Category');
        $form->text('SN', 'SN');
        $form->text('name', 'Name');
        $form->text('type', 'Type');
        $form->text('devicetype', 'Devicetype');
        $form->text('producer', 'Producer');
        $form->text('supplier', 'Supplier');
        $form->decimal('contractprice', 'Contractprice');
        $form->text('contractNo', 'ContractNo');
        $form->text('status', 'Status');
        $form->text('changestatus', 'Changestatus');
        $form->text('location', 'Location');
        $form->text('description', 'Description');
        $form->text('manageIP', 'ManageIP');
        $form->text('appIP', 'AppIP');
        $form->text('hostname', 'Hostname');
        $form->text('project', 'Project');
        $form->text('level', 'Level');
        $form->text('statusofrecord', 'Statusofrecord');
        $form->text('extend1', 'Extend1');
        $form->text('extend2', 'Extend2');

        return $form;
    }
}
