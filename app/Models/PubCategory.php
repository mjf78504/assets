<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class PubCategory extends Model
{

	use ModelTree, AdminBuilder; 
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'pub_category';

    // laravel 访问器
    protected $appends = ['category'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }

    public function getCategoryAttribute() {
        return '分类名称是：'.$this->name;
    }
}
