<?php
namespace App\Helpers;

use App\Models\PubCategory;
use App\Models\PubAddress;
use App\Models\PubContract;
use App\Models\PubManufacturer;
use App\Models\PubProject;
	/** 
	 *	自定义帮助类
	 */
	Class Helperr {

		/** 测试函数 */
		public static function test($num) {
			return $num * $num;
		}

		/** 
		 *	定义分类的查询和生成选项数组
		 */
	    public static function selectt($parent_id = 0, $type = 'pub_category')
	    {
	    	// 从分列表中查询
	    	if ($type == 'pub_category') {
		        $abdds = PubCategory::where('parent_id', $parent_id)->get();
		        $arr = [];
		        foreach( $abdds as $abdd) {
		            $arr = array_add($arr, $abdd->id, $abdd->name);
		        }
		        return $arr;

		    // 从厂商信息表中查询    
	        }else if ($type == 'pub_manufacturer') {
            	$abdds = PubManufacturer::all();
		        $arr = [];
		        foreach( $abdds as $abdd) {
		            $arr = array_add($arr, $abdd->id, $abdd->nickname);
		        }
            	return $arr;

            // 从合同信息表中查询
	        }else if ($type == 'pub_contract') {
            	$abdds = PubContract::all();
		        $arr = [];
		        foreach( $abdds as $abdd) {
		            $arr = array_add($arr, $abdd->id, $abdd->name);
		        }
            	return $arr;

            // 从地址信息表中查询
	        }else if ($type == 'pub_address') {
            	$abdds = PubAddress::all();
		        $arr = [];
		        foreach( $abdds as $abdd) {
		            $arr = array_add($arr, $abdd->id, $abdd->alll);
		        }
            	return $arr;

            // 其他情况直接返回空数组
	        }else if ($type == 'pub_project') {
            	$abdds = PubProject::all();
		        $arr = [];
		        foreach( $abdds as $abdd) {
		            $arr = array_add($arr, $abdd->id, $abdd->nickname);
		        }
            	return $arr;

            // 其他情况直接返回空数组
	        }else {

	        	return $arr = [];

	        }
	    }
	}
?>