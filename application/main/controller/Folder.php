<?php
namespace app\main\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;
class Folder extends Controller
{
    public function index()
    {
        return $this->fetch();

    }

    public function upload(Request $request)
    {
        $filename=$request->param('file');
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
            $info=$file->validate(['ext'=>'xls,xlsx,png,jpg'])->move(ROOT_PATH.'public'.DS.'uploads'.DS.Session::get('username'),'');
//        $info=$file->move(ROOT_PATH.'public'.DS.'uploads','');
            if($info){
                // $this->success('文件上传成功:'.$info->getRealPath());
                $this->success('文件上传成功:'.$filename);
            }
            else{
                $this->error($file->getError());
            }
        }
    }
}
