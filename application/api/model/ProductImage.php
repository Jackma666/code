<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/30
 * Time: 下午7:19
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden=['img_id','delete_time','product_id'];

    /**
     * 定义关联  一对一的关系
     * @return \think\model\relation\BelongsTo
     * 模型名  关联外键  关键主键
     */
    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}