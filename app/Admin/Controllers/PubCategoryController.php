<?php

namespace App\Admin\Controllers;

use App\Models\PubCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubCategoryController extends Controller
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
            ->header('类别列表')
            ->description('配置系统用到的各种类别')
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
            ->header('创建类别')
            ->description('支持根类别和一级类别')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubCategory);

        $grid->id('Id');
        // $grid->parent_id('Parent id');
        $grid->parent_id('类别')->display(function ($id) {
            if($id == 0) {
                return 'Root';
            }else {
                return PubCategory::findOrFail($id)->name;
            }
        });
        $grid->name('属性');
        $grid->description('描述')->limit(24); // 字数限制
        // $grid->created_at('创建时间');
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
        $show = new Show(PubCategory::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->parent_id('Parent id');
        $show->name('Name');
        $show->description('Description');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // 获取类别数据
        $parents = PubCategory::where('parent_id', 0)
            ->orderBy('id')
            ->get();

        // 生成类别数组
        $arr = [0 => 'Root'];
        foreach ($parents as $parent) {
            $arr = array_add($arr, $parent->id, '---- ' . $parent->name);
        }

        $form = new Form(new PubCategory);

        // $form->number('parent_id', 'Parent id');
        $form->select('parent_id', '类别')->options($arr);
        $form->text('name', '属性');
        // $form->text('description', 'Description');
        $form->textarea('description', '描述');

        return $form;
    }
}
