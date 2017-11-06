<?php
namespace app\main\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Validate;
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

    public function upload(Request $request)
    {
        $filename=$request->param('month');
        $rule = [

        ];
        $msg = [

        ];
        $data = [
            'month'  =>$filename,
        ];
        $validate = new Validate($rule,$msg);
        $result   = $validate->check($data);
        if(!$result){
            $this->error($validate->getError());
        }
        else{
            $file=$request->file('file');


            if(empty($file)){
                $this->error('请选择上传文件');
            }
            // 移动到框架应用根目录/public/uploads/
            $info=$file->validate(['ext'=>'xls,xlsx,png'])->move(ROOT_PATH.'public'.DS.'uploads','');
//        $info=$file->move(ROOT_PATH.'public'.DS.'uploads','');
            if($info){
                // $this->success('文件上传成功:'.$info->getRealPath());
                $this->success('文件上传成功:');
            }
            else{
                $this->error($file->getError());
            }
        }
    }
}
