<?php
namespace app\main\controller;
use \think\Controller;
class Folder extends Controller
{
    public function index()
    {
        $this->assign('online', '在线');
        $this->assign('sysname','科大一附院广内网平台');
        $this->assign('messages',99);
        $this->assign('notifications',88);
        $this->assign('tasks',66);
        return $this->fetch('folder/index',[
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

    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file("image");

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                dump($info);

                $this->success();
                echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                echo $info->getFilename();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
}
