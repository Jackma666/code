<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/29
 * Time: 下午9:33
 */

namespace app\api\controller\v1;

//获取商品的详情信息
use app\api\model\Product as ProductModel;
use think\Controller;
use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use think\Exception;
use app\lib\exception\ProductException;


class Product extends Controller
{

    /**
     * 获取最近
     * @param int $count
     * @return mixed
     * @throws ProductException
     */
    public function getRecent($count = 15){
        (new Count())->gocheck();
        $products = ProductModel::getMostRecent($count);//$products是数组对象
        //一组数据集对象，而不是数组
        //不要认为一个product是一个对象，一组product也可以是一个对象
        //    // 数据集返回类型 array 数组 collection Collection对象
        //'resultset_type' => 'collection',

        //如果对数组进行判空就可以
        //如果对一个对象进行判空的话无法进入这个异常，因为他只能使对象下的某个属性为空，而不能把全部变成空
        //写代码最容易出的问题就是对空值的判断
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }


    /**
     * @param $id
     * @return \think\Paginator
     * @throws ProductException
     */
    public function getAllInCategory($id){
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }



    public function getOne($id){
        (new IDMustBePostiveInt())->gocheck();
        $product = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }
        return $product;
    }


}