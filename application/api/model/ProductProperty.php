<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/30
 * Time: 下午7:34
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden=['product_id','delete_time','id'];
}