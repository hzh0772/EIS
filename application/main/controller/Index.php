<?php
namespace app\main\controller;
use \think\Controller;
class Index extends Controller
{
    public function index()
    {

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
