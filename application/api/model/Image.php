<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/13
 * Time: 下午1:52
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    protected $hidden = ['id','from','delete_time','update_time'];

    public function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }




}