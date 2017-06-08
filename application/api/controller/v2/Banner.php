<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/2
 * Time: 上午11:58
 */

namespace app\api\controller\v2;


use think\Controller;
use app\api\model\Theme;

class Banner extends Controller
{

    /*
     * 获取指定id的banner信息
     */
    public function getBanner($id)
    {
//        $Theme = Theme::getStatusAttr($id);
//        return $Theme;
        $Theme = Theme::get($id);
        echo $Theme->status;
    }
}