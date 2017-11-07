<?php
namespace app\main\controller;
use app\main\model\Folder as FolderModel ;
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

    public function download()
    {


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
            $filename= $file->getInfo('name');
            $saveName = iconv("UTF-8", "GB2312", $filename);


            if(empty($file)){
                $this->error('请选择上传文件');
            }
            $info=$file->validate(['ext'=>'rar,txt,png,jpg,xls,xlsx,ppt,pptx,doc,docx'])->rule('uniqid')->move(ROOT_PATH.'public'.DS.'uploads'.DS.Session::get('username'),$saveName);
            if($info){
                $folder=new FolderModel;
                $folder->filename=$filename;
                $folder->owner=Session::get('name');
                $folder->ownerid=Session::get('userid');
                if($folder->save()){
                    $this->success('文件上传成功:'.$filename);
                }
                else $this->error('数据库提交失败！');



            }
            else{
                $this->error($file->getError());
            }
        }
    }
}
