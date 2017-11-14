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

        $arry=  User::get(['username' =>Session::get('username')])->toArray();
        $this->user=$arry;
        foreach($arry as $key=>$value)
        {
            Session::set($key,$value);
        }

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