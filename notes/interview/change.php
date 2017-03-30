<?php
//交换两个变量值，不借助中间变量
$a = 1 ;
$b = 2 ;
list($a,$b) = array($b , $a);
var_dump($a , $b);
