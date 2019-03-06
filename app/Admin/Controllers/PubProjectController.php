<?php

namespace App\Admin\Controllers;

use App\Models\PubProject;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubProjectController extends Controller
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
            ->header('项目')
            ->description(' ')
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
            ->header('项目')
            ->description(' ')
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
            ->header('项目')
            ->description(' ')
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
            ->header('项目')
            ->description(' ')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubProject);

        $grid->id('序号');
        $grid->name('项目名称');
        $grid->nickname('项目简称');
        $grid->leader('负责人');
        // $grid->learderlink('负责人电话');
        $grid->department('业务部门');
        // $grid->directory('文件列表');
        $grid->persons('项目人员');
        $grid->description('项目概述')->limit(36);
        // $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

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
        $show = new Show(PubProject::findOrFail($id));

        $show->id('序号');
        $show->name('项目名称');
        $show->nickname('项目简称');
        $show->leader('负责人');
        $show->learderlink('负责人电话');
        $show->department('业务部门');
        $show->directory('文件列表');
        $show->persons('项目人员');
        $show->description('项目概述');
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
        $form = new Form(new PubProject);

        $form->text('name', '项目名称');
        $form->text('nickname', '项目简称');
        $form->text('leader', '负责人');
        $form->mobile('learderlink', '负责人电话')->options(['mask' => '999 9999 9999']);
        $form->text('department', '业务部门');
        $form->file('directory', '文件列表');
        $form->textarea('persons', '项目人员');
        $form->textarea('description', '项目概述');

        return $form;
    }
}
