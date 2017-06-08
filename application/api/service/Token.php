<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/29
 * Time: 下午4:20
 */

namespace app\api\service;



class Token
{
    //因为这个方法与你的实例对象是没有关系的，所以我们把它定义成静态方法
    //能放在类里边，就不要用common，因为放在common里边容易范懵，一下就不知道怎么回事了
    public static function generateToken(){
        //32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        //用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt
        $salt = config('secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }

}