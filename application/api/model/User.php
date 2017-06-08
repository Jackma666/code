<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/29
 * Time: 下午2:39
 */

namespace app\api\model;


class User extends BaseModel
{
    protected $autoWriteTimestamp = true;

    public function getByOpenID($openid){
        $user = (new User())->where('openid', '=', $openid)
            ->select();
        return $user;
    }

}