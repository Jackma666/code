<?php

/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/3
 * Time: 下午5:31
 */

//我是全局异常处理代码
namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;
use Exception;

/**
 * 让异常与类保持独立，让你的异常处理类变成一个类库
 * Class ExceptionHandler
 * @package app\lib\exception
 */
class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    //还需要返回客户端当前请求的url路径


    /**
     * 重写覆盖render方法,我会拦截掉所有异常
     * 如果一个异常抛出来但是没有被处理，那么就会走向render里面
     * 异常渲染
     * @param Exception $e
     * @return \think\Response|\think\response\Json
     */
    public function render(Exception $e)
    {
        /**
         * 判断如果用户行为导致的异常（没有通过验证，没有查询到结果）
         * 也就是自己定义的异常
         * 也就是validate里面有的异常
         */
        if ($e instanceof BaseException) {
            //如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
            /**
             * 服务器自身异常（代码错误，调用外部接口错误）
             */
        } else {
            /**
             * 开了app_debug就不返回json了，返回tp5异常信息
             * 没有开启app_debug就返回json错误信息
             */
            if(config('app_debug')){
                return parent::render($e);
                //return default error page 还原tp5默认的行为
            }
                $this->code = 500;
                $this->msg = '服务器内部错误，不想告诉你';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }

            $request = Request::instance();
            $result = [
                'msg' => $this->msg,
                'error_code' => $this->errorCode,
                'request_url' => $request->url(),
            ];
            return json($result, $this->code);
    }

    /*
 * 将异常写入日志
 */
    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  LOG_PATH,
            'level' => ['error']
        ]);
//        Log::record($e->getTraceAsString());
        Log::record($e->getMessage(),'error');
    }

}