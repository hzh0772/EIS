<?php
/**
 * Created by PhpStorm.
 * User: hzh
 * Date: 2017/5/26
 * Time: 10:32
 */
define('BASE_URL', realpath(dirname(__FILE__)));
require_once BASE_URL . '/PHPExcel-1.8/Classes/PHPExcel.php';//引入PHPExcel类文件

//excel文件的地址
$excel_fiel_path = './YB201601.xls';


$PHPExcel = new PHPExcel();// 实例化PHPExcel工具类
//分析文件获取后缀判断是2007版本还是2003
$extend = pathinfo("./" . $excel_fiel_path);
$extend = strtolower($extend["extension"]);
// 判断xlsx版本，如果是xlsx的就是2007版本的，否则就是2003
if ($extend=="xlsx") {
    $PHPReader = new PHPExcel_Reader_Excel2007();
    $PHPExcel = $PHPReader->load("./" . $excel_fiel_path);
}else{
    $PHPReader = new PHPExcel_Reader_Excel5();
    $PHPExcel = $PHPReader->load("./" . $excel_fiel_path);

}

/* 第二种方法*/
$objWorksheet = $PHPExcel->getSheetByName('柳江县');
$highestRow = $objWorksheet->getHighestRow();
echo 'highestRow='.$highestRow;
echo "<br>";
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
echo 'highestColumnIndex='.$highestColumnIndex;
echo "<br>";
//$headtitle=array();
$array=array();
for ($row = 2;$row <= $highestRow;$row++)
{
//注意highestColumnIndex的列数索引从0开始
for ($col = 0;$col < $highestColumnIndex;$col++)
{
    $array[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
    echo $array[$col].'  ';
}
    echo "<br>";
//连接mysql ，一条条写入
}

?>

