<?php
/**
 * Created by PhpStorm.
 * User: hzh
 * Date: 2017/7/21
 * Time: 14:59
 *//**
 * Created by PhpStorm.
 * User: hzh
 * Date: 2017/7/4
 * Time: 15:12
 */
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Validate;
use PHPExcel_IOFactory;
use PHPExcel;
use PHPExcel_Cell;

class Writedb extends \think\Controller
{
    private  $yearmonth;
    public function index()
    {
        return $this->fetch();
    }
    public function up(Request $request)
    {
        $filename=$request->param('month');
        $this->yearmonth=$filename;
        $rule = [
            'month'  => 'require|max:25'
        ];
        $msg = [
            'month.require' => '月份必须选择'
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
        $info=$file->validate(['ext'=>'xls,xlsx'])->move(ROOT_PATH.'public'.DS.'uploads',$filename);
//        $info=$file->move(ROOT_PATH.'public'.DS.'uploads','');
        if($info){
            $this->write($info->getRealPath());
           // $this->success('文件上传成功:'.$info->getRealPath());
            $this->assign('文件上传成功:');
        }
        else{
            $this->error($file->getError());
        }
        }
    }

    public function write($excel_path)
    {
        $sheetnames = array('柳州市本级','柳江县','柳城县','鹿寨县','融安县','三江县','融水县','城中区','鱼峰区','柳南区','柳北区','高新开发区','阳和工业新区');
        set_time_limit(0);//设置不超时
        @ini_set('memory_limit', '512M');
        $PHPExcel= new PHPExcel();// 实例化PHPExcel工具类
//分析文件获取后缀判断是2007版本还是2003
        $extend = pathinfo( $excel_path);
        $extend = strtolower($extend["extension"]);
// 判断xlsx版本，如果是xlsx的就是2007版本的，否则就是2003
        if ($extend=="xlsx") {
            $PHPReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $PHPReader->setReadDataOnly(true);
            $PHPReader->setLoadSheetsOnly($sheetnames);      // 加载多个工作表，传入工作表名字数组
            $PHPExcel = $PHPReader->load($excel_path);
        }else{
            $PHPReader = \PHPExcel_IOFactory::createReader('Excel5');
            $PHPReader->setReadDataOnly(true);
            $PHPReader->setLoadSheetsOnly($sheetnames);
            $PHPExcel = $PHPReader->load($excel_path);

        }
        foreach($sheetnames as $sheet)
        {
            $objWorksheet = $PHPExcel->getSheetByName($sheet);
            $highestRow = $objWorksheet->getHighestRow();
            echo $sheet;
            echo$this->yearmonth;
//            echo 'highestRow='.$highestRow;
//            echo "<br>";
            $highestColumn = $objWorksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
//            echo 'highestColumnIndex='.$highestColumnIndex;
//            echo "<br>";
//$headtitle=array();
            $array=array();
            for ($row = 5;$row <= $highestRow;$row++)
            {
//注意highestColumnIndex的列数索引从0开始
                for ($col = 0;$col < 3;$col++)
                {
                    $array["sequence"]=$row;
                    switch($col){
                        case 0:
                            $array["finance_id"] =$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                        case 1:

                            $array["name"] =$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                            $array["name"]= mb_convert_encoding ($array['name'],'UTF-8');
//                            $array['name']=iconv("gb2312","utf-8//IGNORE",$array['name']);
                            // $array['name']=iconv('GB2312', 'UTF-8//ignore', $array['name']);
                        case 2:
                            $array["value"] =$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                        default:
                            break;
                    }

//                    $array[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();


//                    echo $array[$col+1].'  ';
                }
//连接mysql ，一条条写入
                $array['region']=$sheet;
                $array['time']=$this->yearmonth;
                Db::table('sr')->insert($array);

            }
        }


        /* 第二种方法*/

    }


}