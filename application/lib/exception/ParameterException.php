<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/6/3
 * Time: 上午11:31
 */

namespace app\lib\exception;

use think\Exception;


/**
 * 参数异常错误
 * Class ParameterException
 * @package app\lib\exception
 */
class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;


}
