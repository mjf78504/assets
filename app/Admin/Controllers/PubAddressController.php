<?php

namespace App\Admin\Controllers;

use App\Models\PubAddress;
use App\Models\PubCategory;
use App\Models\NetDevice;
use App\Models\PubCabinet;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubAddressController extends Controller
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
            ->header('地址管理')
            ->description('所有地址列表')
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
            ->header('地址详情')
            ->description('')
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
            ->description('地址信息')
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
            ->description('具体地址')
            ->body($this->form());
    }

    /** 获取下拉框所属分类的函数 */
    public function getcategories($id) {
        $categories = PubCategory::where('parent_id', $id)->get();
        $arr = [];
        foreach ($categories as $category) {
            $arr = array_add($arr, $category->id, $category->name);
        }
        return $arr;
    }

    /** 获取机柜列表all */
    public function getcabinet($id) {  // 注意：
        $categories = NetDevice::where('type', $id)->get();
        $arr = [];
        foreach ($categories as $category) {
            $arr = array_add($arr, $category->id, $category->name);
        }
        return $arr;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubAddress);

        $grid->id('序号');
        /**
        $grid->column('abc', '详细地址')->display(function(){
            return $this->id . '-' . $this->detail;
        });
        */
        $grid->alll('详细地址');
        // $grid->created_at('创建时间');
        $grid->location('机房位置')->display(function($location) {
            $local =PubCategory::find($location);
            return $local ? $local->name : '无';
        });
        $grid->position('设备位置')->display(function($position) {
            $posi = PubCategory::find($position);
            return $posi ? $posi->name : '无';
        });
        $grid->cabinet('机柜')->display(function($cabinet) {
            $cab = NetDevice::find($cabinet);
            return $cab ? $cab->name : '无';
        });
        $grid->detail('更多');
        // $grid->description('地址说明');
        $grid->updated_at('最后更新');

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
        $show = new Show(PubAddress::findOrFail($id));

        $show->id('序号');
        $show->alll('详细地址');
        $show->location('机房位置')->as(function($local) {
            $local =PubCategory::find($local);
            return $local ? $local->name : '无';
        });
        $show->position('设备位置')->as(function($position) {
            $posi = PubCategory::find($position);
            return $posi ? $posi->name : '无';
        });
        $show->cabinet('机柜')->as(function($cabinet) {
            $cab = NetDevice::find($cabinet);
            return $cab ? $cab->name : '无';
        });
        $show->detail('更多');
        $show->description('地址描述');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PubAddress);

        $form->select('location', '机房位置')->options($this->getcategories(2));
        $form->select('position', '设备位置')->options($this->getcategories(3));
        $form->select('cabinet', '机柜')->options($this->getcabinet(54));
        $form->text('detail', '更多')->rules('required');
        $form->textarea('description', '地址说明');

        return $form;
    }
}
