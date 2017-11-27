<?php
namespace app\main\controller;
use \think\Controller;
use think\Request;
use think\Session;
use think\Validate;
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
    public function uploadpicture(Request $request)
    {
        $filename=$request->param('image');
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
            $file=$request->file('image');
            $filename= $file->getInfo('name');
            $saveName = iconv("UTF-8", "GB2312", $filename);


            if(empty($file)){
                $this->error('请选择上传文件');
            }
            $info=$file->validate(['ext'=>'jpg'])->move(ROOT_PATH.'public'.DS.'profile'.DS.'picture',Session::get('username'),true);
            if($info){

                    $this->success('更新头像成功');
                }

            else{
                $this->error($file->getError());
            }
        }
    }
}