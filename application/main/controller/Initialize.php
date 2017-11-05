<?php
namespace app\main\controller;
use \think\Controller;
class Initialize
{
    public $user;
    function __construct()
    {
        $this->user();
    }

    function user()
    {
        $this->user= [
            'name'  => session('name'),
            'username' => session('username'),
            'title' =>session('title'),
            'position'=>session('position'),
            'sex'=>session('sex'),
            'followers'=>'100',
            'thumbs'=>'99',
            'friends'=>'22',
            'messages'=>'99',
            'notifications'=>'11',
            'tasks'=>'66',
            'online'=>'在线'
        ] ;
    }
}