<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/2
 * Time: 下午10:05
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;
use think\Exception;


/**
 * validate的基类
 * Class BaseValidate
 * @package app\api\validate
 */
class BaseValidate extends Validate
{


    /**
     * validate验证拦截器
     * @return bool
     * @throws Exception
     */
    public function gocheck()
    {
        //拿请求
        $requst = Request::instance();
//        dump($requst); //object(think\Request)  包含了rule
        //拿参数
        $params = $requst->param();
//        dump($params);  //array uri里面的参数

        $result = $this->check($params);
//        dump($result);

        if (!$result) {
            throw new ParameterException([
                'msg' => $this->error
            ]);
        } else {
            return true;
        }
    }


}