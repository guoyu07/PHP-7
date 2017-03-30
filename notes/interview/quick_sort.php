<?php

$sort = array(5,23,34,1,3,75,34,5,6,8,35);

function quickSort($arr)
{
    $len = count($arr);
    
    if($len <= 1){
        $ret = ($len == 1)? $arr : array() ;
        return $ret ;
    }
    $key = $arr[0] ;
    $lt_arr = $gt_arr = array();
    for($i = 1;$i <$len ;$i++)
    {
        if($key <= $arr[$i])
        {
            $gt_arr[] = $arr[$i] ;
        }
        else
        {
            $lt_arr[] = $arr[$i] ;
        }
    }
    
    $new_lt = quickSort($lt_arr);
    $new_gt = quickSort($gt_arr);
    
    $new_arr = array_merge($new_lt , array($key) , $new_gt);
    return $new_arr ;
}

var_dump(quickSort($sort));
