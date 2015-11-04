<?php
$file_name = "喝啊大叔啊是的V在程序执行阿斯顿爱仕达阿斯顿发生的发生大的事dwfasdfadsafasd";
if(mb_strlen($file_name) > 10) {
    $file_name = mb_substr($file_name, 0 , 3) .'...'.mb_substr($file_name, -3) ;
}
echo $file_name ;

