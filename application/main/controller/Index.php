<?php
namespace app\main\controller;
use \think\Controller;
class Index extends Controller
{
    public function index()
    {
        //        return $this->fetch('login',[],['__STATIC__'=>'/public/static']);


//        $this->assign('online', '在线');
//        $this->assign('sysname','科大一附院广内网平台');
        $int=new Initialize();
//        return $this->fetch('index/index',[
//            'name'  => session('name'),
//            'username' => session('username'),
//            'title' =>session('title'),
//            'position'=>session('position'),
//            'sex'=>session('sex'),
//            'followers'=>'100',
//            'thumbs'=>'99',
//            'friends'=>'22'
//
//        ]);
        return $this->fetch('index/index');
//        $this->view->engine->layout(false); 屏蔽模板输出
//        return $this->fetch('index/index2');
    }


}
