<?php

namespace App\Admin\Controllers;

use App\Models\PubContract;
use App\Models\PubCategory;
use App\Models\pubAddress;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Helpers\Helperr;

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
            ->header('合同管理')
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
            ->header('合同管理')
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
            ->header('合同管理')
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
            ->header('合同管理')
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
        $grid = new Grid(new PubContract);

        $grid->id('序号');
        // $grid->created_at('创建时间');
        // $grid->updated_at('更新时间');
        $grid->name('合同名称');
        $grid->operator('经办人');
        $grid->description('合同概述')->limit(36);
        $grid->local('存放位置')->display(function($local) {
            $address = pubAddress::find($local);
            return $address ? $address->alll : $local;
        });
        $grid->status('合同状态')->display(function($status) {
            return PubCategory::find($status)->name;
        });
        $grid->startdate('生效时间');
        $grid->enddate('失效时间');

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

        $show->id('序号');
        $show->name('合同名称');
        $show->operator('经办人');
        $show->description('合同概述');
        $show->local('存放位置')->as(function($local) {
            $address = pubAddress::find($local);
            return $address ? $address->alll : $local;
        });
        $show->status('合同状态')->as(function($status) {
            return PubCategory::find($status)->name;
        });
        $show->startdate('生效时间');
        $show->enddate('失效时间');
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
        $form = new Form(new PubContract);

        $form->text('name', '合同名称');
        $form->text('operator', '经办人');
        $form->text('description', '合同描述');
        $form->select('local', '存放位置')->options(Helperr::selectt(0, 'pub_address'));
        $form->select('status', '状态')->options(Helperr::selectt(34));
        $form->datetime('startdate', '生效日期')->default(date('Y-m-d H:i:s'));
        $form->datetime('enddate', '结束日期')->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
