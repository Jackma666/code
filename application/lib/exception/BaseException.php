<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/3
 * Time: 下午11:15
 */

namespace app\lib\exception;
use think\Exception;



/**
 * //统一描述错误：错误码、错误信息、当前URL
 * Class BaseException
 * @package app\lib\exception
 */
class BaseException extends Exception
{
    //HTTP  return code 400,200
    //需要外部访问的成员变量
    public $code = 400;

    //错误具体信息
    public $msg = '参数错误';

    //自定义错误码
    public $errorCode = 10000;

    /**
     * 实例化传参的构造方法
     * ParameterException constructor.
     * @param array $params
     */
    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
//            throw new Exception('参数必须是数组');
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errorCode = $params['errorCode'];
        }
    }

}