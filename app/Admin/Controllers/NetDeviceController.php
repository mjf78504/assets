<?php

namespace App\Admin\Controllers;

use App\Models\NetDevice;
use App\Models\PubProperty;
use App\Models\PubCategory;
use App\Models\PubManufacturer;
use App\Models\PubContract;
use App\Models\PubAddress;
use App\Models\PubProject;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Form as Formm;

use App\Helpers\Helperr;

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
        \Log::info('测试结果是：' . Helperr::test(5));
        return $content
            ->header('资产')
            ->description('设备列表')
            ->breadcrumb(['text' => '资产列表', 'url' => '/network'])
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
            ->header('详情')
            ->description('设备关联信息')
            ->breadcrumb(
                ['text' => '资产列表', 'url' => '/network'],
                ['text' => '资产详情'])
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
            return '<a href="network/' . $id . '">' . str_pad($id, 8, '0', STR_PAD_LEFT). '</a>';
        })->sortable();
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
        $grid->category('分组')->display(function($category){
            return PubCategory::find($category)->name;
        })->sortable();
        $grid->SN('SN');
        $grid->name('名称')->sortable()->limit(18);
        $grid->type('类型')->display(function($type) {
            return PubCategory::find($type)->name;
        });
        $grid->devicetype('型号');
        $grid->producer('制造商')->display(function($producer) {
            return PubManufacturer::find($producer)->nickname;
        });
        $grid->location('位置')->display(function ($location) {
            $local = PubAddress::find($location);
            return $local ? $local->alll : $location;
        })->limit(24);
        // $grid->description('描述');
        $grid->status('运行状态')->display(function($status) {
            $a = PubCategory::find($status)->name;
            if ($status == 39) {
                return "<span style='color:green; font-weight:bold'>$a</span>";
            }else {
                return "<span style='color:red; font-weight:bold'>$a</span>";
            }
        });
        //$grid->supplier('供货商');
        // $grid->contractprice('合同价格');
        // $grid->contractNo('合同编号');
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

        /** 过滤器设置 */
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 下拉过滤菜单
            $filter->scope('a', '网络类')->where('category', 17);
            $filter->scope('b', '系统类')->where('category', 16);
            $filter->scope('c', '安全类')->where('category', 18);
            $filter->scope('d', '办公')->where('category', 19);

            $filter->column(6, function ($filter) {
                // 在这里添加第一列字段过滤器
                $filter->equal('category', '分组')->select(Helperr::selectt(4));
                $filter->equal('type', '类型')->select(Helperr::selectt(6));
                $filter->equal('status', '状态')->select(Helperr::selectt(38));
            });
            $filter->column(6, function ($filter) {
                $filter->like('id', '设备编号')->placeholder('输入编号中的数字。。。');
                $filter->like('name', '设备名称')->placeholder('模糊搜索。。。');
                $filter->like('SN', 'SN')->placeholder('模糊搜索。。。');
            });
        });

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
        /** 使用Tab的方式 */
        $tab = new Tab();

        /** tab:基础信息-开始 */
        $netdevice = NetDevice::findOrFail($id);
        $netdevices = array_only($netdevice->toArray(), [ 'id', 'category', 'name', 'type', 'devicetype', 'level', 'location', 'description', 'producer', 'supplier', 'contractNo', 'status', 'manageIP', 'appIP', 'maintaindate', 'updatetime', 'hostname', 'project']);
        $columns1 = [];
        $columns1 = array_add($columns1, '设备编号', 'NET' . str_pad($netdevices['id'], 8, '0', STR_PAD_LEFT));
        $columns1 = array_add($columns1, '设备分组', PubCategory::findOrFail($netdevices['category'])->name);
        $columns1 = array_add($columns1, '设备类型', PubCategory::findOrFail($netdevices['type'])->name);
        $columns1 = array_add($columns1, '设备型号', $netdevices['devicetype']);
        $columns1 = array_add($columns1, '设备等级', PubCategory::findOrFail($netdevices['level'])->name);
        $columns1 = array_add($columns1, '设备位置', PubAddress::findOrFail($netdevices['location'])->alll);
        $columns1 = array_add($columns1, '设备描述', $netdevices['description']);
        $columns1 = array_add($columns1, '制造商', PubManufacturer::findOrFail($netdevices['producer'])->name);
        $columns1 = array_add($columns1, '供货商', PubManufacturer::findOrFail($netdevices['supplier'])->name);

        $columns2 = [];
        $columns2 = array_add($columns2, '合同', PubContract::findOrFail($netdevices['contractNo'])->name);
        $columns2 = array_add($columns2, '运行状态', PubCategory::findOrFail($netdevices['status'])->name);
        $columns2 = array_add($columns2, '管理IP', $netdevices['manageIP']);
        $columns2 = array_add($columns2, '应用IP', $netdevices['appIP']);
        $columns2 = array_add($columns2, '维保日期', $netdevices['maintaindate']);
        $columns2 = array_add($columns2, '更新日期', $netdevices['updatetime']);
        $columns2 = array_add($columns2, '主机名', $netdevices['hostname']);
        $columns2 = array_add($columns2, '所属项目', PubProject::findOrFail($netdevices['project'])->name);
        $data = [
            'columns1' => $columns1,
            'columns2' => $columns2,
            'escape'    => true,
            'wrapped'   => true,
            'title' => '新标题',
            'style' => 'info',
            'tools' => '工具栏'
        ];
        
        $tab->add('基础信息', view('showw.default', $data));
        /** tab:基础信息-结束 */
    
        /** tab:配置信息-开始 */
        $grid = new Grid(new PubProperty);
        $grid->model()->where('net_devices_id', '=', $id); // 修改模型数据来源
        $grid->disablePagination(); // 禁用分页
        $grid->disableFilter(); // 禁用查询过滤器
        $grid->disableCreateButton(); // 禁用创建按钮
        $grid->disableExport(); // 禁用导出
        $grid->disableRowSelector();  // 禁用行选择
        $grid->disableActions(); // 禁用行操作列
        // $grid->perPages([10, 20, 30, 40, 50]);  // 设置分页选择
        // $grid->id('属性编号');
        $grid->proname('属性名称');
        $grid->provalue('属性值');
        $grid->prodesc('属性说明');
        $grid->updated_at('最后更新');

        $tab->add('配置信息', $grid->render());
        /** tab:配置信息-结束 */

        /** tab:合同信息-开始 */
        $contract = PubContract::find($netdevices['contractNo']);
        $show = new Show($contract);
        $show->panel()->style('default')->title(' '); // 设置面板样式
        $show->panel()->tools(function ($tools) {   // 设置工具栏
            $tools->disableEdit();   // 禁用编辑
            $tools->disableList();   // 禁用列表
            $tools->disableDelete(); // 禁用删除
        });;

        $show->id('序号')->link();
        $show->name('合同名称');
        $show->operator('经办人');
        $show->description('合同概述');
        $show->local('存放位置');
        $show->status('状态')->as(function($statusId) {
            $status = PubCategory::find($statusId)->name;
            return $status;
        })->label();
        $show->startdate('生效时间');
        $show->enddate('失效时间');

        $tab->add('合同信息', $show->render());
        /** tab:合同信息-结束 */


        // $tab->add('厂商信息', new Table());
        $tab->add('项目信息', '这里展示与项目相关的信息。');
        // $tab->add('操作记录', '这里是关于这个设备的所有操作记录');
        $tab->addLink('操作记录', '../auth/logs');

        return $tab;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */

    protected function form() 
    {

        $form = new Form(new NetDevice);

        $form->row(function($row) use ($form){

            $row->width(4)->select('category', '设备分组')->options(Helperr::selectt(4))->rules('required');
            $row->width(4)->text('name', '设备名称')->rules('required|min:2');
            $row->width(4)->text('SN', 'SN')->rules('required|min:3');          
            $row->width(4)->select('type', '设备类型')->options(Helperr::selectt(6))->rules('required');
            $row->width(4)->text('devicetype', '设备型号');
            $row->width(4)->select('level', '设备等级')->options(Helperr::selectt(24));
            $row->width(4)->select('location', '设备位置')->options(Helperr::selectt(0, 'pub_address'));
            $row->width(4)->text('description', '设备描述');
            $row->width(4)->select('producer', '制造商')->options(Helperr::selectt(0, 'pub_manufacturer'));
            $row->width(4)->select('supplier', '供货商')->options(Helperr::selectt(0, 'pub_manufacturer'));
            // $row->decimal('contractprice', '合同价格');
            $row->width(4)->select('contractNo', '合同')->options(Helperr::selectt(0, 'pub_contract'));
            $row->width(4)->select('status', '运行状态')->options(Helperr::selectt(38));
            $row->width(4)->ip('manageIP', '管理IP');
            $row->width(4)->ip('appIP', '应用IP');
            $row->date('maintaindate', '维保日期')->default(date('Y-m-d'));
            $row->datetime('updatetime', '更新日期')->default(date('Y-m-d H:i:s'));
            $row->width(4)->text('hostname', '主机名');
            $row->width(4)->select('project', '所属项目')->options(Helperr::selectt(0, 'pub_project'));
            
            $row->width(4)->hidden('statusofrecord')->value(0);
            // $row->html('<h4>添加私有屬性</h4>');
            // $row->text('extend1', 'Extend1');
            // $row->text('extend2', 'Extend2');

        }, $form);

        $form->row(function($row) use ($form){
            $row->hasMany('pub_properties', '私有属性', function(Form\NestedForm $form){
                $form->text('proname', '属性名称');
                $form->text('provalue', '属性值');
                $form->textarea('prodesc', '属性描述');
                $form->hidden('protytype1')->value(0);
            });
        }, $form);

        \Log::info('------创建设备表单---------');
        return $form;
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
