<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/14
 * Time: 下午2:29
 */

namespace app\api\model;


class Theme extends BaseModel
{

    public  function getStatusAttr($value)
    {
        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$value];
    }


    //关联关系的定法在于你要从哪里调用当前方法，就在哪里定这个关联关系
    public function topicImg(){
        //(关联模型名,本模型外键,关联模型主键)
        //这个关联关系是主从关系，不能互换
        // 需要互换使用$this->hasOne()是反过来的belongsTo
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }



}