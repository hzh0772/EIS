<?php
namespace app\main\controller;
use \think\Controller;
class Profile extends Controller
{
    public function index()
    {
        $this->assign('online', '在线');
        $this->assign('sysname','科大一附院广内网平台');
        $this->assign('messages',99);
        $this->assign('notifications',88);
        $this->assign('tasks',66);
        return $this->fetch('profile/index',[
            'name'  => session('name'),
            'username' => session('username'),
            'title' =>session('title'),
            'position'=>session('position'),
            'sex'=>session('sex'),
            'followers'=>'100',
            'thumbs'=>'99',
            'friends'=>'22'

        ]);

    }
}