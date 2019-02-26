<?php

namespace App\Admin\Controllers;

use App\Models\PubProperty;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubPropertyController extends Controller
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
            ->header('列表')
            ->description('设备属性')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $contentContent
     * @return 
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description('设备描述')
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
            ->description('设备属性')
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
            ->description('设备属性')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubProperty);

        $grid->id('Id');

        $grid->proname('属性名称');
        $grid->provalue('属性值');
        $grid->net_devices_id('设备编号');
        // $grid->protype1('Protype1');
        // $grid->protype2('Protype2');
        $grid->prodesc('属性说明')->limit(32);
        // $grid->created_at('Created at');
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
        $show = new Show(PubProperty::findOrFail($id));

        $show->id('Id');
        // $show->created_at('Created at');
        $show->proname('属性名称');
        $show->provalue('属性值');
        $show->net_devices_id('设备编号');
        // $show->protype1('Protype1');
        // $show->protype2('Protype2');
        $show->prodesc('属性说明');
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
        $form = new Form(new PubProperty);

        $form->text('proname', '属性名称');
        $form->text('provalue', '属性值');
        $form->text('net_devices_id', '设备编号');
        // $form->number('protype1', 'Protype1');
        // $form->number('protype2', 'Protype2');
        $form->text('prodesc', '属性说明');

        return $form;
    }
}
