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
use think\Validate;

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
        /**
         * 如果id不是正整数就不会通过,gocheck会抛出一个exception
         */
        (new IDMustBePostiveInt())->gocheck();
        /**
         * model如果取不到就会报下边的错误
         */
        $banner = BannerModel::getBannerByID($id);
//         异常捕获
         if(!$banner){
             throw new Exception('内部错误');
//             throw new BannerMissException();
         }
            return $banner;
         //如果目标是一个对象的话，怎么对这个对象的属性进行处理？
    }


    public function getBanner_old1($id){

        // 独立验证
        //验证器
        $data =  [
            'name' => 'verd111111or',
            'email' => 'aaa163.com',
        ];

        $validate = new Validate([
            'name' => 'require|max:10',
            'email' => 'email',
        ]);

        $result = $validate->batch()->check($data);
        var_dump($validate->getError());

    }


    public function getBanner_old($id){
        //验证器
        $data = [
            'id' => $id,
        ];
        $validate = new IDMustBePostiveInt();
        //batch批量验证，如果没有batch验证只返回一条，有batch验证可以返回多条
        $result = $validate->batch()
            ->check($data);
        if($result){

        }else{
            var_dump($validate->getError());
        }
    }


    //老版异常处理
    public function getBanner_error($id){
        (new IDMustBePostiveInt())->gocheck();
        try{
        $banner = BannerModel::getBannerByID2($id);
        }catch (Exception $ex){
            $err = [
                'error_code' => 10001,
                'msg' => $ex->getMessage(),
            ];
            return json($err,400);
        }
        return $banner;
    }



}