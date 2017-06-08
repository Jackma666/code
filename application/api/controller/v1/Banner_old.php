<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/2
 * Time: 上午11:58
 */

namespace app\api\controller\v1;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use think\Controller;
use app\lib\exception\BannerMissException;
use think\Exception;

class Banner extends Controller
{


    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http get
     * @id banner的id号
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws BannerMissException
     */
    public function getBanner($id)
    {
        //就像一个拦截器 AOP 面向切面编程
        (new IDMustBePostiveInt())->gocheck();
        $banner = BannerModel::getBannerByID($id);
//         异常捕获
        if (!$banner) {
            throw new BannerMissException();
        }
        return $banner;
        //如果目标是一个对象的话，怎么对这个对象的属性进行处理？
    }


//
//    public function getBanner_old($id)
//    {
//        //就像一个拦截器 AOP 面向切面编程
//        (new IDMustBePostiveInt())->gocheck();
//        try
//        (
//        $banner = BannerModel::getBannerByID($id);
//        )
//        catch (Exception\ $ex)
//    {
//            $err = [
//                'error_code' => 1001,
//                'msg' => $ex->getMessage();
//            ]
//            return json($err,400);
//    }
//    return $banner;
//    }






}