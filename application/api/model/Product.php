<?php

namespace app\api\model;

use think\Model;
use app\api\model\BaseModel;

class Product extends BaseModel
{

    protected $autoWriteTimestamp = 'datetime';

    //这个pivot是数据库里边没有的，是关联的表里面的中间字段，可以隐藏
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'from', 'category_id',
        'create_time', 'update_time'];




    /**
     * 图片属性
     * hasMany用于一对多
     * 如果没有return 就会报如下错误
     * call to a member function eagerlyResult() on null
     */
    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }


    public function properties()
    {
        //model  关联外键|参数model的外键     关联主键|类mode的主键
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    /**
     * 获取某分类下商品
     * @param $categoryID
     * @param int $page
     * @param int $size
     * @param bool $paginate
     * @return \think\Paginator
     */
    public static function getProductsByCategoryID(
        $categoryID, $paginate = true, $page = 1, $size = 30)
    {
        $query = self::
        where('category_id', '=', $categoryID);
        if (!$paginate)
        {
            return $query->select();
        }
        else
        {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, true, [
                'page' => $page
            ]);
        }
    }


    /**
     * 获取商品详情
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     */
    public static function getProductDetail($id)
    {
        /**
         * with的作用在于join进新的model  .field 为字段  imgs是model名
         */
        $product = self::with('imgs,properties')
                    ->find($id);

        /**
         * Query  链式方法
         * 闭包写法,with里面传入关联数组，
         * $query对象是查询构造器
         */
        $product = self::with([
            'imgs'=>  function($query){
                $query->with(['imgUrl'])
                    ->order('order','asc');
            }
        ])
            ->with(['properties'])
            ->find($id);

        return $product;
    }



    /**返回最近的
     * @param $count
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getMostRecent($count)
    {
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }


}
