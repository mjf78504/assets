<?php

use Illuminate\Database\Seeder;

class PubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pub_category')->insert([
        [
            'parent_id' => '0',
            'name' => '机构',
            'description' => '柳州银行、智控国际、柳州金控',
        ],
        [
            'parent_id' => '0',
            'name' => '机房位置',
            'description' => '柳州中心机房、同城移动机房、异地武汉机房',
        ],
        [
            'parent_id' => '0',
            'name' => '设备位置',
            'description' => '生产机房、测试机房、设备库房、其他',
        ],
        [
            'parent_id' => '0',
            'name' => '设备种类',
            'description' => '系统、网络、安全、办公',
        ],
        [
            'parent_id' => '0',
            'name' => '变更状态',
            'description' => '已入库、已出库、生产、测试、已下架、其他',
        ],
        [
            'parent_id' => '4',
            'name' => '设备类型',
            'description' => '交换机，防火墙，服务器',
        ],
    ]);
    }
}
