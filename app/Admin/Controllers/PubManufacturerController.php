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
        $grid = new Grid(new PubManufacturer);

        $grid->id('Id');
        $grid->nickname('Nickname');
        $grid->name('Name');
        $grid->type('Type');
        $grid->leader('Leader');
        $grid->linkman('Linkman');
        $grid->description('Description');
        $grid->personscount('Personscount');
        $grid->persons('Persons');
        $grid->extend1('Extend1');
        // $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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

        $show->id('Id');
        $show->name('Name');
        $show->type('Type');
        $show->leader('Leader');
        $show->linkman('Linkman');
        $show->description('Description');
        $show->personscount('Personscount');
        $show->persons('Persons');
        $show->extend1('Extend1');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

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
