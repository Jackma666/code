<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/2
 * Time: 下午8:53
 */

namespace app\api\validate;

use think\validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id'  =>  'require|isPositiveInteger'
    ];

    protected function isPositiveInteger($value, $rule = '',
                                         $data = '', $field = ''){

        if(is_numeric($value)  &&  is_int($value + 0) &&
            ($value + 0) > 0) {
            return true;
        }
        else{
            return $field.'必须是正整数';
        }
    }


    protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }


}