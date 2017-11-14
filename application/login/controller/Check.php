<?php
namespace app\login\controller;
use app\login\model\User;
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
        elseif(!$this->checkDB($data))
        {
            $this->error('无效的用户名');
        }
        else
        {
            $this->success('登录成功', 'main/index/index');
        }


    }
    public function checkDB($data)
    {
//        $sql_text='部门表';
//        $sql_text=iconv("utf-8","gb2312//IGNORE",$sql_text);
//        $result = Db::query('select * from think_user where id=:id',['id'=>8]);
//        $result = Db::connect($conn, true)->table('部门表')->select();//
//        $tools=new Tools();
//        $result = $tools->array_iconv('gb2312', 'utf-8', $result);
//        $data = [
//            'username'=>'zlhis',
//            'password' =>'yfy'
//        ];
        $post_data=(array) $data;
        $url = "http://localhost/hislogin/hislogin.php";
//        $post_data = array ("username" => "bob","key" => "12345");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $info=json_decode($output);
        if($info->status=="success")
        {

            $user=new User;
//            $user->where('username',$info->username)->find();
//            dump($user->where('username',$info->username)->find());
            if(empty($user->where('username',$info->username)->find()))
            {
                $user->name=$info->name;
                $user->dept=$info->dept;
                $user->username=$info->username;
                $user->position=$info->position;
                $user->title=$info->title;
                $user->sex=$info->sex;
                $user->save();
                session::set('username',$info->username);
                return  true;
            }
            else
            {
                $user->where('username',$info->username)
                    ->update([
                        'name' =>$info->name,
                        'dept' =>$info->dept,
                        'position' =>$info->position,
                        'title' =>$info->title,
                        'sex' =>$info->sex
                    ]);
                session::set('username',$info->username);
                return  true;
            }


        }
        return  false;

    }





}
