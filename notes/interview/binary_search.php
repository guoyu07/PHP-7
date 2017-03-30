<?php
$arr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14);

function binary_search($ar , $search_key)
{
    $low = 0 ;
    $high = count($ar)-1 ;
    while($low <= $high)
    {
        $mid = intval(($low + $high)/2);
        if($ar[$mid] > $search_key){
            $high = $mid - 1 ;
        }else if($ar[$mid] == $search_key){
            return $mid ;
        }else{
            $low = $mid + 1;
        }
    }
    return -1 ;
}

var_dump(binary_search($arr , 25));
