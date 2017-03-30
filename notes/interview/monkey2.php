<?php

function monkeyKing($m ,$n)
{
    //赋值
    $init = range(1,$m);
    $i = 0 ;
    while(count($init)>1){
        if(($i+1) % $n != 0){
            array_push($init,$init[$i]) ;
        }
        unset($init[$i]);
        $i++ ;
    }
    return $init[$i]; 
}

var_dump(monkeyKing(100,3));
