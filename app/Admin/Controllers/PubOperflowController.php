<?php

namespace App\Admin\Controllers;

use App\Models\PubOperflow;
use App\Models\PubCategory;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class PubOperflowController extends Controller
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
        $grid = new Grid(new PubOperflow);

        $grid->id('Id');
        $grid->type('Type');
        $grid->applicant('Applicant');
        $grid->operator('Operator');
        $grid->description('Description');
        $grid->status('Status');
        $grid->updatetime('Updatetime');
        $grid->deviceId('DeviceId');
        $grid->created_at('Created at');
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
        $show = new Show(PubOperflow::findOrFail($id));

        $show->id('Id');
        $show->type('Type');
        $show->applicant('Applicant');
        $show->operator('Operator');
        $show->description('Description');
        $show->status('Status');
        $show->updatetime('Updatetime');
        $show->deviceId('DeviceId');
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
        // 获取类别数据
        $datas = PubCategory::where('parent_id', 5)->orderBy('id')->get();

        // 生成类别数组
        $arr = [];
        foreach ($datas as $data) {
            $arr = array_add($arr, $data->id, $data->name);
        }

        $form = new Form(new PubOperflow);

        $form->select('type', '变更类型')->options($arr);
        $form->text('applicant', '申请人');
        $form->text('operator', '执行人');
        $form->text('description', '变更说明');
        $form->text('status', '变更状态');
        $form->datetime('updatetime', '更新时间')->default(date('Y-m-d H:i:s'));
        $form->text('deviceId', 'DeviceId');

        return $form;
    }
}
