<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PubProperty;

class NetDevice extends Model
{
    //
	// protected $guarded = [];	// 所有属性都可以被批量赋值。
	
    public function pub_properties()
    {
        return $this->hasMany(PubProperty::class, 'net_devices_id');
    }
}
