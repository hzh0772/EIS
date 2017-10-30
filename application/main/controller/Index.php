<?php
namespace app\main\controller;
use \think\Controller;
class Index extends Controller
{
    public function index()
    {
        //        return $this->fetch('login',[],['__STATIC__'=>'/public/static']);

        $this->assign('online', '在线');
        $this->assign('sysname','科大一附院广内网平台');
        $this->assign('messages',99);
        $this->assign('notifications',88);
        $this->assign('tasks',66);
        return $this->fetch('index/index',[
            'username'  => '黄中和',
            'userid' => 'U0866',
            'job' =>'助理工程师',
            'followers'=>'100',
            'thumbs'=>'99',
            'friends'=>'22'

        ]);
//        $this->view->engine->layout(false); 屏蔽模板输出
//        return $this->fetch('index/index2');
    }


}
