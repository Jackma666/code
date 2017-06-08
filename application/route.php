<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//Route::rule('路由表达式','路由地址','请求类型','路由参数(数组)','变量规则(数组)');



Route::post('api/:version/token/user','api/:version.Token/getToken');

Route::get('api/:version/Banner/:id','api/:version.Banner/getBanner');

Route::get('api/:version/Banner_err/:id','api/:version.Banner/getBanner_error');


////规定id是个正整数才用此路由
//Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//Route::get('api/:version/product/recent','api/:version.Product/getRecent');
//Route::get('api/:version/product/by_category',);


//分组路由  关键子group
Route::group('api/:version/product',function(){
    Route::get('/by_category','api/:version.Product/getAllCategory');
    Route::get('/recent','api/:version.Product/getRecent');
    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
});



