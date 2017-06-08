<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //这个进一步不够灵活，我们还是适当的退一步
    protected function prefixImgUrl($value,$data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
