<?php

namespace App\Models;

use App\Models\PubCategory;

use Illuminate\Database\Eloquent\Model;

class PubAddress extends Model
{
    // laravel 访问器
    protected $appends = ['alll'];

    public function getAlllAttribute()
    {
   		// 获取分类
        $category = PubCategory::find($this->location);
        $type = PubCategory::find($this->position);
        $cabinet = NetDevice::find($this->cabinet);

        $category ? $location = $category->name : $location = '';
        $type ? $position = $type->name : $position = '';
        $cabinet ? $cabinet1 = $cabinet->name : $cabinet1 = '';
        return $location.'-'.$position.'-'.$cabinet1.'-'.$this->detail;
    }
}
