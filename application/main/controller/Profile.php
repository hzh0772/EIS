<?php
namespace app\main\controller;
use \think\Controller;
class Profile extends Controller
{
    public function index()
    {
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

        return $this->fetch();

    }
    public function  uploadpicture()
    {

    }
}