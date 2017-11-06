<?php
/**
 * Created by PhpStorm.
 * User: hzh
 * Date: 2017/7/4
 * Time: 15:12
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class Upload extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function up(Request $request)
    {
        $file=$request->file('file');
        if(empty($file)){
           $this->error('请选择上传文件');
        }
        // 移动到框架应用根目录/public/uploads/
        $info=$file->validate(['ext'=>'xls,xlsx'])->move(ROOT_PATH.'public'.DS.'uploads','07');
//        $info=$file->move(ROOT_PATH.'public'.DS.'uploads','');
        if($info){
            $this->success('文件上传成功:'.$info->getRealPath());
        }
        else{
            $this->error($file->getError());
        }
    }
}