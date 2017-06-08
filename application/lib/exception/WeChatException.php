<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/25
 * Time: 下午11:07
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}