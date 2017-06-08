<?php

/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/25
 * Time: 下午9:03
 */

namespace app\api\service;

//service处理较为复杂的业务   model处理较为细粒度简单的业务逻辑
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;


/**
 *  function List
 * __construct  构造出wxLoginUrl  并且声明为全局变量方便调用
 * get   访问微信接口获得$wxResult
 * grantToken   获取Token令牌
 * saveTocache   写入缓存 返回令牌
 * prepareCacheValue   准备缓存
 * newUser  新建用户
 * processLoginError 异常处理函数
 */

/**
 * Class UserToken
 * @package app\api\service
 *
 */


class UserToken extends Token
{
    //表示从客户端传过来的code
    protected $code;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;


    /**
     * 构造函数
     * @access public
     * UserToken constructor.
     * @param string $code 微信code码
     */
    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(
            config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }


    /**
     * 访问微信接口获得$wxResult  最终获得token
     * @param $code
     * @throws Exception
     * @return array $wxResult
     * @return  string token  微信返回数组
     * 微信的接口不是一个标准的resful风格，无论成功还是失败微信都会返回一个200的返回码
     * 所以我们无法通过http状态码来判断
     */
    public function get($code){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            //这个涉及到异常的地位与选取的关系，因为我不想让他返回到客户端去，所以我使用了think的exception
            throw new Exception('获取session_Key及openID时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errorcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }


    /**
     * 获取Token
     * @param array $wxResult
     * @return string $token
     */
    private function grantToken($wxResult){
        //1、拿到openid
        //2、数据库里看一下，这个openid是不是已经存在了
        //3、如果存在则不处理，如何不存在那么就新增一条user记录
        //4、生成令牌，准备缓存数，写入缓存
        //5、把令牌返回到客户端去
        //key:令牌（token）
        //valueL:wxResult [0=>sessionkey,1=>openid,2=>exceptionin],uid,scope
        $openid = $wxResult['openid'];
        $user = (new UserModel())->getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid);
        }
        $cacheValue = $this->prepareCacheValue($wxResult,$uid);
        $token = $this->saveTocache($cacheValue);
        return $token;
    }

    /**
     * 保存到缓存，并返回令牌
     * @param $cacheValue
     * @return string $key
     * @throws TokenException
     */
    private function saveTocache($cacheValue){
        $key = self::generateToken();  //generate 使形成
        $value = json_encode($cacheValue); //返回json形式的字符串
        $expire_in = config('setting.token_expire_in');

        //这里我们使用的是tp5自带的缓存,默认情况下使用的是文件系统进行缓存
        $requst = cache($key,$value,$expire_in);
        if(!$requst){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005,
            ]);
        }
        return $key;

    }


    /**
     *组装$cacheValue
     * @param array $wxResult
     * @param int $uid
     * @return array cacheValue
     */
    private function prepareCacheValue($wxResult,$uid){
        $cacheValue = $wxResult;
        $cacheValue['uid']= $uid;
        //scope在在计算机内可以翻译成作用域的意思，数值越大说明权限越大
        $cacheValue['scope'] = 16;
        return $cacheValue;
    }



    /**
     * 新建用户
     * @param  string $openid
     * @return mixed  model
     */
    private function newUser($openid){
        $user = UserModel::create([
            'openid' => $openid,
        ]);
        return $user->id;
    }

    /**
     * 异常处理函数
     */
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errormsg'],
            'errorCode' => $wxResult['errorcode'],
        ]);
    }


}