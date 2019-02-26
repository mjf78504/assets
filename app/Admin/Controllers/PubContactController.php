<?php

namespace App\Admin\Controllers;

use App\Models\PubContact;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PubContactController extends Controller
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
        $grid = new Grid(new PubContact);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->name('Name');
        $grid->nickname('Nickname');
        $grid->mobile1('Mobile1');
        $grid->mobile2('Mobile2');
        $grid->phone('Phone');
        $grid->email('Email');
        $grid->weixin('Weixin');
        $grid->qq('Qq');
        $grid->address('Address');

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
        $show = new Show(PubContact::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->name('Name');
        $show->nickname('Nickname');
        $show->mobile1('Mobile1');
        $show->mobile2('Mobile2');
        $show->phone('Phone');
        $show->email('Email');
        $show->weixin('Weixin');
        $show->qq('Qq');
        $show->address('Address');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PubContact);

        $form->text('name', 'Name');
        $form->text('nickname', 'Nickname');
        $form->text('mobile1', 'Mobile1');
        $form->text('mobile2', 'Mobile2');
        $form->number('phone', 'Phone');
        $form->email('email', 'Email');
        $form->text('weixin', 'Weixin');
        $form->text('qq', 'Qq');
        $form->text('address', 'Address');

        return $form;
    }
}
