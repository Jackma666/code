<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/13
 * Time: 下午1:28
 */

namespace app\api\model;


use think\Model;

class BannerItem extends  BaseModel
{
    protected $hidden = ['id','img_id','banner_id','update_time','delete_time'];
    public function image(){
        //  （关联模型的模型名，类model关键外键，参数model的主键）  为了可读性，能写完整就写完整
        return $this->belongsTo('Image','img_id','id');
    }

}