<?php
namespace app\main\controller;
use app\main\model\User;
use think\Controller;
use think\Model;
use think\Session;
class Initialize extends Controller
{
    public $user;
    function __construct()
    {
        $this->user();
    }


    function user()
    {
        //初始化User，读取数据库USER值，存入Session
        $arry=  User::get(['username' =>Session::get('username')])->toArray();
        $this->user=$arry;
        foreach($arry as $key=>$value)
        {
            Session::set($key,$value);
        }
        //设置默认头像
//        if(!Session::has('headimg')){
//            Session::set('headimg','default.jpg');
//        }

//        dump($this->user);
//        $this->user= [
//            'name'  => session('name'),
//            'username' => session('username'),
//            'title' =>session('title'),
//            'position'=>session('position'),
//            'sex'=>session('sex'),
//            'followers'=>'100',
//            'thumbs'=>'99',
//            'friends'=>'22',
//            'messages'=>'99',
//            'notifications'=>'11',
//            'tasks'=>'66',
//            'online'=>'在线'
//        ] ;
    }
}