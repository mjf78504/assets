<?php

namespace App\Admin\Controllers;

use App\Models\NetDevice;
use App\Models\PubProperty;
use App\Models\PubCategory;
use App\Models\PubManufacturer;
use App\Models\PubContract;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Layout\Row;

class NetDeviceController extends Controller
{
    use HasResourceActions;

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
            ->header('编辑')
            ->description('设备信息')
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
            ->header('创建')
            ->description('设备信息')
            // ->row($this->form())
            ->body($this->form());
            /**
            ->row(function(Row $row) {
                $row->column(1, '');    
                $row->column(10, $this->form());
            });
            */
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NetDevice);

        $grid->id('设备编号')->display(function($id) {
            return 'NET' . str_pad($id, 8, '0', STR_PAD_LEFT);
        });
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
        $grid->category('种类');
        $grid->SN('SN');
        $grid->name('名称');
        $grid->type('类型');
        $grid->devicetype('型号');
        $grid->producer('制造商');
        $grid->location('位置');
        $grid->description('描述');
        $grid->status('运行状态');
        //$grid->supplier('供货商');
        // $grid->contractprice('合同价格');
        $grid->contractNo('合同编号');
        $grid->maintaindate('维保');
        //$grid->manageIP('管理IP');
        //$grid->appIP('应用IP');
        //$grid->hostname('主机名');
        // $grid->project('所属项目');
        $grid->level('等级');
        $grid->updatetime('更新时间');
        // $grid->statusofrecord('记录状态');
        // $grid->extend1('Extend1');
        // $grid->extend2('Extend2');

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
        // 尝试查询
        $a = NetDevice::findOrFail($id);
        $b = PubProperty::findOrFail(1);
        $show = new Show($a);
        $show->pub_properties('属性信息', function ($properties) {
            // 必须用resource()方法设置comments资源的url访问路径
            $properties->resource('/network');
            $properties->proname('属性名称');
            $properties->provalue('属性值');
        });
        // $show->proname('属性名称');
        // $show->provalue('属性值');
        /** 
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
*/
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */

    protected function form() {

        $form = new Form(new NetDevice);

        $form->row(function($row) use ($form){
            
            /** 获取分类信息*/
            $categories = PubCategory::all();
            $manufacturers = PubManufacturer::all();
            $contracts = PubContract::all();

            // 生成类别数组
            $arr1 = [];
            $arr2 = [];
            $arr3 = [];
            $arr4 = [];
            $arr5 = [];
            $arr6 = [];
            foreach ($categories as $category) {
                if ($category->parent_id == 4) {
                    $arr1 = array_add($arr1, $category->id, $category->name);
                }else if ($category->parent_id == 6) {
                    $arr2 = array_add($arr2, $category->id, $category->name);
                }else if ($category->parent_id == 24) {
                    $arr3 = array_add($arr3, $category->id, $category->name);
                }
            };

            // 生成厂商数组
            foreach($manufacturers as $manufacturer) {
                $arr5 = array_add($arr5, $manufacturer->id, $manufacturer->nickname);
            };

            // 生成合同数组
            foreach($contracts as $contract) {
                $arr4 = array_add($arr4, $contract->id, $contract->name);
            };
            
            $row->width(4)->select('category', '设备种类')->options($arr1);
            $row->width(4)->text('name', '设备名称')->rules('required|min:2');
            $row->width(4)->text('SN', 'SN')->rules('required|min:3');          
            $row->width(4)->select('type', '设备类型')->options($arr2);
            $row->width(4)->text('devicetype', '设备型号');
            $row->width(4)->select('level', '设备等级')->options($arr3);
            $row->width(4)->text('location', '设备位置');
            $row->width(4)->text('description', '设备描述');
            $row->width(4)->select('producer', '制造商')->options($arr5);
            $row->width(4)->select('supplier', '供货商')->options($arr5);
            // $row->decimal('contractprice', '合同价格');
            $row->width(4)->select('contractNo', '合同')->options($arr4);
            $row->width(4)->select('status', '运行状态')->options(['0' => '启动', '1' => '停止']);
            $row->width(4)->ip('manageIP', '管理IP');
            $row->width(4)->ip('appIP', '应用IP');
            $row->date('maintaindate', '维保日期')->default(date('Y-m-d'));
            $row->datetime('updatetime', '更新日期')->default(date('Y-m-d H:i:s'));
            $row->width(4)->text('hostname', '主机名');
            $row->width(4)->text('project', '所属项目');
            
            $row->width(4)->hidden('statusofrecord')->value(0);
            // $row->html('<h4>添加私有屬性</h4>');
            // $row->text('extend1', 'Extend1');
            // $row->text('extend2', 'Extend2');

        }, $form);

        $form->row(function($row) use ($form){
            $row->hasMany('pub_properties', '私有属性', function(Form\NestedForm $form){
                $form->text('proname', '属性名称');
                $form->text('provalue', '属性值');
                $form->textarea('prpdesc', '属性描述');
                $form->hidden('protytype1')->value(0);
            });
        }, $form);


        \Log::info('------创建设备表单---------');
        return $form;

/**
        $form->text('name', '设备名称');
        $form->text('producer', '制造商');
        $form->text('properties.name', '属性名称');
        $form->divide();
        // $form->html('', $label = '路漫漫其修远兮');

        $form->hasMany('pub_properties', '私有属性', function (Form\NestedForm $form) {
            $form->text('proname', '属性名称');
        });
*/
    }

    protected function form1()
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
