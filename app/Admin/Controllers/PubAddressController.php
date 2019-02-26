<?php

namespace App\Admin\Controllers;

use App\Models\PubAddress;
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
        $grid = new Grid(new PubAddress);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->location('Location');
        $grid->position('Position');
        $grid->cabinet('Cabinet');
        $grid->detail('Detail');
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
        $show = new Show(PubAddress::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->location('Location');
        $show->position('Position');
        $show->cabinet('Cabinet');
        $show->detail('Detail');
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
        $form = new Form(new PubAddress);

        $form->number('location', 'Location');
        $form->number('position', 'Position');
        $form->number('cabinet', 'Cabinet');
        $form->text('detail', 'Detail');
        $form->text('description', 'Description');

        return $form;
    }
}
