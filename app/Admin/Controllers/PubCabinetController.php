<?php

namespace App\Admin\Controllers;

use App\Models\PubCabinet;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubCabinetController extends Controller
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
        $grid = new Grid(new PubCabinet);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->name('Name');
        $grid->type('Type');
        $grid->tag('Tag');
        $grid->SN('SN');
        $grid->address('Address');
        $grid->description('Description');

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
        $show = new Show(PubCabinet::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->name('Name');
        $show->type('Type');
        $show->tag('Tag');
        $show->SN('SN');
        $show->address('Address');
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
        $form = new Form(new PubCabinet);

        $form->text('name', 'Name');
        $form->text('type', 'Type');
        $form->text('tag', 'Tag');
        $form->text('SN', 'SN');
        $form->text('address', 'Address');
        $form->text('description', 'Description');

        return $form;
    }
}
