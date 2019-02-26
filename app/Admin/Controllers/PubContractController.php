<?php

namespace App\Admin\Controllers;

use App\Models\PubContract;
use App\Models\PubCategory;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubContractController extends Controller
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
        $grid = new Grid(new PubContract);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->name('Name');
        $grid->operator('Operator');
        $grid->description('Description');
        $grid->local('Local');
        $grid->status('Status');
        $grid->startdate('Startdate');
        $grid->enddate('Enddate');

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
        $show = new Show(PubContract::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->name('Name');
        $show->operator('Operator');
        $show->description('Description');
        $show->local('Local');
        $show->status('Status');
        $show->startdate('Startdate');
        $show->enddate('Enddate');

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
        $categories = PubCategory::where('parent_id', 34)->get();
        // 生成类别数组
        $arr1 = [];
        foreach ($categories as $category) {
                $arr1 = array_add($arr1, $category->id, $category->name);
        };

        $form = new Form(new PubContract);

        $form->text('name', '合同名称');
        $form->text('operator', '签订人');
        $form->text('description', '合同描述');
        $form->text('local', '存放位置');
        $form->select('status', '状态')->options($arr1);
        $form->datetime('startdate', '生效日期')->default(date('Y-m-d H:i:s'));
        $form->datetime('enddate', '结束日期')->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
