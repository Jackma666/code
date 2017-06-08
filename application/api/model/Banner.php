<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/3
 * Time: 下午2:07
 */

namespace app\api\model;

use think\Model;
use think\Exception;

class Banner extends BaseModel
{
    protected $hidden = ['update_time', 'delete_time'];


    /**
     * banner一对多外键关联items的主键
     * @return \think\model\relation\HasMany
     */
    public function items()
    {
        //(关联模型名,本模型外键,关联模型主键)
        //  （关联模型的模型名，关键外键，当前模型的主键）
        return self::hasMany('BannerItem', 'banner_id', 'id');
    }


    /**
     * 通过ID获取banner
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     */
    public static function getBannerByID($id)
    {
        //with设置关联查询JOIN预查询,就是把bannerItem的image列给join进去
        $banner = self::with(['items', 'items.image'])
            ->find($id);
        return $banner;
    }

    /**
     * 开发api的时候向客户端返回这么一个html页面是不可以的，
     * 因为客户端没有办法处理这个html页面，如果客户端是个IOS？
     * @param $id
     * @return string
     * @throws Exception
     */
    public static function getBannerByID2($id)
    {
        try {
            1/0;
        } catch (Exception $ex){
            throw  $ex;
        }
    return 'this is banner info';

}


}