<?php

namespace App\Admin\Controllers;

use App\Models\PubCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use App\Models\NetDevice;
// 用于模型树
use Encore\Admin\Facades\Admin;
// use Encore\Admin\Controllers\ModelForm;

use App\Http\Resources\PubCategory as PubCategoryResource;

class PubCategoryController extends Controller
{
    use HasResourceActions;
    // use ModelForm;

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
            ->row(function(Row $row) {
                $row->column(4, $this->tree());
                $row->column(8, $this->grid());
            });
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
     * show tree.  模型树
     *
     * @param Content $content
     * @return Content
     */
    public function tree()
    {
        return PubCategory::tree();
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PubCategory);
        $grid->model()->where('parent_id', '!=', '99999');
        $grid->model()->orderBy('parent_id', 'asc');
        $grid->model()->orderBy('id', 'asc');
        // $grid->model()->orderBy('id', 'desc');

        $grid->id('Id');
        // $grid->parent_id('Parent id');
        $grid->parent_id('父类')->display(function ($parent_id) {
            if($parent_id == 0) {
                return '0-Root';
            }else {
                return $parent_id . '-' . PubCategory::findOrFail($parent_id)->name;
            }
        });
        $grid->name('属性');
        $grid->description('描述')->limit(24); // 字数限制
        // $grid->created_at('创建时间');
        $grid->updated_at('最后更新');

        /** 分页设置 */
        // $grid->perPages([100, 200]);
        $grid->paginate(100);

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
        $form->select('sort', '排序')->options([1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9']);
        $form->textarea('description', '描述');

        return $form;
    }

    /**
     * api 接口信息处理
     */
    public function category($category) {
        return new PubCategoryResource(PubCategory::findOrFail($category)); // 单个资源
    }


    /**
     * 返回接口單條數據
     */
    public static function single() {
        \Log::info('----你好嗎？-----');
        return NetDevice::where('category', 17)->where('location', 1)->get();

        // return response()->json(['abc' => '來吧哥哥']);
    }
}
