<?php
namespace app\login\controller;
class  Tools
{
//    public function mult_iconv($in_charset,$out_charset,$data)
//    {
//        if(substr($out_charset,-8)=='//IGNORE'){
//            $out_charset=substr($out_charset,0,-8);
//        }
//        if(is_array($data)){
//            foreach($data as $key => $value){
//                if(is_array($value)){
//                    $key=iconv($in_charset,$out_charset.'//IGNORE',$key);
//                    $rtn[$key]=mult_iconv($in_charset,$out_charset,$value);
//                }elseif(is_string($key) || is_string($value)){
//                    if(is_string($key)){
//                        $key=iconv($in_charset,$out_charset.'//IGNORE',$key);
//                    }
//                    if(is_string($value)){
//                        $value=iconv($in_charset,$out_charset.'//IGNORE',$value);
//                    }
//                    $rtn[$key]=$value;
//                }else{
//                    $rtn[$key]=$value;
//                }
//            }
//        }elseif(is_string($data)){
//            $rtn=iconv($in_charset,$out_charset.'//IGNORE',$data);
//        }else{
//            $rtn=$data;
//        }
//        return $rtn;
//    }

    function array_iconv($in_charset, $out_charset, $arr)
    {
        return eval('return ' . iconv($in_charset, $out_charset, var_export($arr, true) . ';'));
    }

    public function transPsw($stringpsw){
        //请求页面为http://localhost/management/index.php/Dao/transPsw
        $arr1=array("0" => "W", "1" => "I", "2" => "N", "3" => "T", "4" => "E", "5" => "R", "6" => "P", "7" => "L", "8" => "U", "9" => "M",
            "A" => "H", "B" => "T", "C" => "I", "D" => "O", "E" => "K", "F" => "V", "G" => "A", "H" => "N", "I" => "F", "J" => "J",
            "K" => "B", "L" => "U", "M" => "Y", "N" => "G", "O" => "P", "P" => "W", "Q" => "R", "R" => "M", "S" => "E", "T" => "S",
            "U" => "T", "V" => "Q", "W" => "L", "X" => "Z", "Y" => "C", "Z" => "X");

        $arr2=array("0" => "7", "1" => "M", "2" => "3", "3" => "A", "4" => "N", "5" => "F", "6" => "O", "7" => "4", "8" => "K", "9" => "Y",
            "A" => "6", "B" => "J", "C" => "H", "D" => "9", "E" => "G", "F" => "E", "G" => "Q", "H" => "1", "I" => "T", "J" => "C",
            "K" => "U", "L" => "P", "M" => "B", "N" => "Z", "O" => "0", "P" => "V", "Q" => "I", "R" => "W", "S" => "X", "T" => "L",
            "U" => "5", "V" => "R", "W" => "D", "X" => "2", "Y" => "S", "Z" => "8");

        $arr3=array(
            "0" => "6", "1" => "J", "2" => "H", "3" => "9", "4" => "G", "5" => "E", "6" => "Q", "7" => "1", "8" => "X", "9" => "L",
            "A" => "S", "B" => "8", "C" => "5", "D" => "R", "E" => "7", "F" => "M", "G" => "3", "H" => "A", "I" => "N", "J" => "F",
            "K" => "O", "L" => "4", "M" => "K", "N" => "Y", "O" => "D", "P" => "2", "Q" => "T", "R" => "C", "S" => "U", "T" => "P",
            "U" => "B", "V" => "Z", "W" => "0", "X" => "V", "Y" => "I", "Z" => "W");

        $str=strtoupper($stringpsw);
        $rest=null;
        $psw="";
        for ($i=1;$i<=strlen($str);$i++){
            $rest=substr($str,$i-1,1);
            if($i%3==1){
                $new=$arr1[$rest];
                $psw=$psw.$new;
            }else if($i%3==2){
                $new=$arr2[$rest];
                $psw=$psw.$new;
            }else if($i%3==0){
                $new=$arr3[$rest];
                $psw=$psw.$new;
            }
        }
        return $psw;
    }
}
