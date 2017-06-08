<?php
/**
 * Created by PhpStorm.
 * User: zhongzijian
 * Date: 17/5/29
 * Time: 下午10:23
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];
}