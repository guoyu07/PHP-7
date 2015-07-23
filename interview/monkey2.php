<?php

function monkeyKing($m ,$n)
{
    $init = array();
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

    var_dump($init,$i);
}

monkeyKing(100,3);
