<?php
namespace app\login\controller;
use think\Controller;
use think\Request;
use think\Validate;
use think\Db;
use think\Session;
class  Check extends Controller
{

    public function index()
    {
        $request = Request::instance();
//        dump($request->param());
//        echo 'username:'.$request->param('username');
//        $this->checkuser($request->param('username'),$request->param('password'));
        $this->checkuser($request->param());

    }

    public function checkuser($data)
    {
        $rule = [
            ['username','require','账户不能为空'],
            ['password','require','密码不能为空']
        ];
        $validate = new Validate($rule);
//        $data = [
//            'username'  =>$username ,
//            'password' => $password
//        ];
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        elseif(!$this->checkDB())
        {
            $this->error('无效的用户名');
        }
        else $this->success('登录成功', 'main/index/index');


    }
    public function checkDB()
    {
//        $sql_text='部门表';
//        $sql_text=iconv("utf-8","gb2312//IGNORE",$sql_text);
//        $result = Db::query('select * from think_user where id=:id',['id'=>8]);
//        $result = Db::connect($conn, true)->table('部门表')->select();//
        $tools=new Tools();
//        $result = $tools->array_iconv('gb2312', 'utf-8', $result);
        session::set('name','黄中和');
        session::set('deptname','信息科');
        session::set('username','U08662');
        session::set('position','普通职员');
        session::set('title','助理工程师');
        session::set('sex','男');
        return true;

    }

}
