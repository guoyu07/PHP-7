<?php
$arr = array();
$a = count($arr) ;

var_dump($a);


$a1 = array(1,2,3,25,31);
$a2 = array(2,16,20,83,90,100);
$b  = $a1 + $a2 ;

$c  = array_merge($a1 , $a2);
var_dump($b,$c);

$arr = array();

var_dump($arr > 0);

$blackList = array('abc','acd','bas','kkk') ;
$adv = "Hello world!!!";
$isBlack = false ;
foreach($blackList as $black){
    if(strpos($black , $adv) !== false){
        $isBlack = true ;
        break ;
    }
}

if ($isBlack) {
    
} else {
    
}
