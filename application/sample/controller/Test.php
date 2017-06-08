<?php

namespace app\sample\controller;

use think\Request;

class Test{
    public function hello($id,$name,$age){
        $all = Request::instance()->param(); //返回的是一个数组
        var_dump($all);

        echo $id;
        echo '|';
        echo $name;
        echo '|';
        echo $age;

    }
}