<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/25
 * Time: 下午4:35
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
      'code' => 'require|isNotEmpty'
    ];

    protected $message = [
      'code' => '没有code还想获取Token,做梦哦'
    ];

}