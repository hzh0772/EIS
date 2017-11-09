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
        $this->download(Session::get('userid'));
        $this->download();

        return $this->fetch();

    }

    public function download($userid='')
    {

        if(!''==$userid)
        {
            $folder=new FolderModel();
            $myfilelist = $folder->where('userid',$userid)->select();
            $this->assign('myfilelist',$myfilelist);
        }
        else
        {
            $folder1=new FolderModel();
            $publicfilelist= $folder1->where('public','1')->select();
            $this->assign('publicfilelist',$publicfilelist);
        }

    }

    public function delete($fileid)
    {
        $folder=new FolderModel();
        $folder=$folder->where('fileid',$fileid)->find();
        $path=ROOT_PATH.'public'.DS.'uploads'.DS.$folder->username.DS.$folder->coding;
        if(!unlink($path))
        {
            $this->error('删除失败');
        }
        else
        {
            $folder->delete();
            $this->success('删除成功:'.$folder->filename);
        }
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
            $info=$file->validate(['ext'=>'rar,txt,png,jpg,xls,xlsx,ppt,pptx,doc,docx'])->rule('uniqid')->move(ROOT_PATH.'public'.DS.'uploads'.DS.Session::get('username'),true,false);
            if($info){
                $folder=new FolderModel;
                $folder->filename=$filename;
                $folder->coding=$info->getSaveName();
                $folder->name=Session::get('name');
                $folder->userid=Session::get('userid');
                $folder->username=Session::get('username');
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

    public function upload2(Request $request)
    {
        $filename=$request->param('publicfile');
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
            $file=$request->file('publicfile');
            $filename= $file->getInfo('name');
            $saveName = iconv("UTF-8", "GB2312", $filename);


            if(empty($file)){
                $this->error('请选择上传文件');
            }
            $info=$file->validate(['ext'=>'rar,txt,png,jpg,xls,xlsx,ppt,pptx,doc,docx'])->rule('uniqid')->move(ROOT_PATH.'public'.DS.'uploads'.DS.Session::get('username'),true,false);
            if($info){
                $folder=new FolderModel;
                $folder->filename=$filename;
                $folder->coding=$info->getSaveName();
                $folder->name=Session::get('name');
                $folder->userid=Session::get('userid');
                $folder->username=Session::get('username');
                $folder->public=1;
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
