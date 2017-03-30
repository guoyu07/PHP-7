<?php
/*
$flag = is_dir('vying');
var_dump($flag);

echo realpath('vying');
$test = range(1,10);
var_dump($test);
var_dump(91 == '9x1');


function asm($n)
{
    $arr = range(1,$n);
    return array_sum($arr);
}

var_dump(asm(100));

function shutdown()
{
    echo "shutdown";
}
echo "abccc";
register_shutdown_function('shutdown');
*/
$string = "Hello world";
$len = strlen($string);
for ($i=0 ;$i<$len/2;$i++){
    $back = $len - $i - 1;
    list($string{$i} , $string{$back}) = array($string{$back} ,$string{$i});
}

echo $string ;
