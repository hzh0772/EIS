<?php
namespace app\main\controller;
use \think\Controller;
use think\Request;
use think\Session;
use think\Validate;
use think\Db;
class Profile extends Controller
{
    public function index()
    {
//          return $this->fetch('profile/index',[
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

        return $this->fetch();

    }
    public function uploadpicture(Request $request)
    {
        $file=$request->file('image');
        if(empty($file)){
            $this->error('请选择上传文件');
        }
        $info=$file->validate(['ext'=>'jpg','size'=>512000])->rule('uniqid')->move(ROOT_PATH.'public'.DS.'profile'.DS.'picture',true,false);

        if($info){
            $result=Db::table('user')->where('username',Session::get('username'))->find();
            $path=ROOT_PATH.'public'.DS.'profile'.DS.'picture'.DS.$result['headimg'];
            if(file_exists($path))
            {
                unlink($path);
            }
            Db::table('user')->where('username',Session::get('username'))->setField('headimg', $info->getSaveName());
            Session::set('headimg',$info->getSaveName());
            $this->success('更新头像成功');
        }

        else{
            $this->error($file->getError());
        }
    }





}