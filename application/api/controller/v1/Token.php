<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/25
 * Time: 下午4:31
 */

namespace app\api\controller\v1;
use app\api\validate\TokenGet;
use app\api\service\UserToken;


/**
 * Class Token
 * @package app\api\controller\v1
 *
 *
 * 主要的业务逻辑写在了service/UserToken里面  还有Token基类里边
 * controller只是简单的调用封装好的接口而已
 */
  class Token
{
    //用post方式，只不过把参数隐藏在了body里面，如果要真的达到安全就需要使用https的方式
    //面向对象不能再类内直接声明，要声明状态
    public function getToken($code = ''){
        //实例化对象拦截器检查
         (new TokenGet())->gocheck();
         //实例化token
         $ut = new UserToken($code);
         //调用方法
         $token = $ut->get($code);
         //我们所有的返回结果都要求是json形式的，$token是字符串，我们把它改为关联数组，这个关联数组返回回去
        //以后框架会把它默认序列化为json的形式
         return [
             'token' => $token
         ];
    }


}