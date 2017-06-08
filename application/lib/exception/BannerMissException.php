<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/3
 * Time: 下午11:20
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banner不存在';
    public $errorCode = 40000;
}