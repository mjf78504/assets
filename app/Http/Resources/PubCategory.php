<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PubCategory extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

                return [
                    'id' => $this->id,
                    'text' => $this->name,
                    'lailai' => 'Hao shuai de xiao gege !',
                    'links' => [
                        'self' => 'link-value',
                    ],
                ];

    }
}
