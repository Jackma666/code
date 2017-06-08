<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/29
 * Time: 下午5:30
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}