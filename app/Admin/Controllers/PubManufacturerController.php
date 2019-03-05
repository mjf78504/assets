<?php

namespace App\Admin\Controllers;

use App\Models\PubManufacturer;
use App\Models\PubCategory;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubManufacturerController extends Controller
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
            ->header('厂商列表')
            ->description('厂商信息展示')
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
            ->header('厂商')
            ->description('详情信息')
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
            ->description('')
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
            ->description('新增厂商')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubManufacturer);

        $grid->id('序号');
        $grid->nickname('简称');
        $grid->name('全称');
        $grid->type('类型')->display(function($type) {
            return PubCategory::find($type)->name;
        });
        $grid->leader('负责人');
        $grid->linkman('联系方式');
        // $grid->description('Description')->limit(24);
        $grid->personscount('参与人数');
        // $grid->persons('Persons');
        // $grid->extend1('Extend1');
        // $grid->created_at('Created at');
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
        $show = new Show(PubManufacturer::findOrFail($id));

        $show->id('序号');
        $show->nickname('简称');
        $show->name('全称');
        $show->type('厂商类型');
        $show->leader('负责人');
        $show->linkman('联系方式');
        $show->description('说明');
        $show->personscount('参与人数');
        $show->persons('参与人');
        // $show->extend1('Extend1');
        // $show->created_at('Created at');
        $show->updated_at('最后更新');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        /** 获取分类信息*/
        $categories = PubCategory::where('parent_id', 29)->get();
        // 生成类别数组
        $arr1 = [];
        foreach ($categories as $category) {
                $arr1 = array_add($arr1, $category->id, $category->name);
        };

        $form = new Form(new PubManufacturer);

        $form->text('name', '单位名称');
        $form->text('nickname', '单位简称');
        $form->select('type', '厂商类别')->options($arr1);
        $form->text('leader', '负责人');
        $form->mobile('linkman', '联系方式')->options(['mask' => '999 9999 9999']);
        $form->number('personscount', '参与人数');
        $form->textarea('persons', '参与人信息');
        $form->textarea('description', '描述说明');
        // $form->text('extend1', 'Extend1');

        return $form;
    }
}
