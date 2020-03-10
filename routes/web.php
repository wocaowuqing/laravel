<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 *  后台登录
 */
Route::get('/login', function () {
    // echo "111";exit;
    return view('/admin/login/login');
});
Route::post('login/logindo', "Admin\AdminController@loginDo"); //图片添加
/**
 *  首页
 */
Route::get('/admin', function () {
    // echo "首页";exit;
    return view('admin/index/index');
});
/**
 *  轮播图
 */
Route::get('wheel/add', "Admin\WheelController@add"); //图片添加
Route::post('wheel/create', "Admin\WheelController@create"); //图片添加
Route::any('wheel/index', "Admin\WheelController@index"); //图片添加
Route::post('wheel/upd', "Admin\WheelController@upd"); //即点即改

/**
 *  球队管理
 */
Route::get('team/add', "Admin\TeamController@add"); //添加
Route::post('team/create', "Admin\TeamController@create"); //添加
Route::get('team/index', "Admin\TeamController@index"); //展示


/**
 *  球员管理
 */
Route::get('player/add/{id?}', "Admin\PlayerController@add"); //添加
Route::post('player/create', "Admin\PlayerController@create"); //添加
Route::get('player/index', "Admin\PlayerController@index"); //展示

/**
 *  比赛管理
 */
Route::get('match/add', "Admin\MatchController@add"); //添加
Route::post('match/create', "Admin\MatchController@create"); //添加
Route::get('match/index', "Admin\MatchController@index"); //展示

/**
 *  比赛数据
 */
Route::get('data/add/{id?}', "Admin\DataController@add"); //添加
Route::any('data/create', "Admin\DataController@create"); //添加
Route::get('data/index', "Admin\DataController@index"); //展示

/**
 *  赛况直播
 */
Route::get('outs/add', "Admin\OutsController@add"); //添加
Route::post('outs/create', "Admin\OutsController@create"); //添加
Route::get('outs/index', "Admin\OutsController@index"); //展示

/**
 *  前台
 */
Route::get('index/index', "Index\IndexController@index"); //首页

Route::get('index/match', "Index\MatchController@match"); //添加

Route::get('index/information', "Index\InformationController@information"); //添加


//2级前台
Route::any('shop/index', "Show\IndexController@index"); //前台展示

Route::any('shop/match', "Show\MatchController@match"); //比赛页面

Route::any('shop/information', "Show\InformationController@information"); //排名页面

Route::any('shop/ranking', "Show\InformationController@ranking"); //排名页面

Route::any('shop/count', "Show\MatchController@count"); //统计页面

Route::any('shop/countshow', "Show\MatchController@countshow"); //统计页面


//直播
Route::any('good/index','goods\GoodsController@index');
Route::any('good/detail','goods\GoodsController@detail');
Route::any('good/login','goods\GoodsController@login');
Route::any('good/login_do','goods\GoodsController@login_do');
Route::any('good/create','goods\DetailController@create');
Route::any('good/store','goods\DetailController@store');
Route::any('good/node','goods\DetailController@node');
Route::any('good/team','goods\DetailController@team');