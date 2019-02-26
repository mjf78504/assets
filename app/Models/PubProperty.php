<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NetDevice;

class PubProperty extends Model
{
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['id', 'proname', 'provalue', 'net_devices_id', 'protype1', 'protype2', 'prodesc'];
    // protected $guarded = [];  // 所有属性都可以被批量赋值。

    public function net_devices()
    {
        return $this->belongsTo(NetDevice::class, 'net_devices_id');
    }
}
