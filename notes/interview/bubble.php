<?php
$sort = array(12,32,53,12,57,2,3,6,18,30);

function bubbleSort($arr)
{
    $len = count($arr);
    for($i = 0 ; $i < $len - 1 ; $i++)
    {
        $flag = true ;
        for($j=0 ; $j < $len-$i-1 ; $j++)
        {
            if($arr[$j] > $arr[$j+1])
            {
                list($arr[$j+1] ,$arr[$j]) = array($arr[$j] ,$arr[$j+1]);
                $flag = false ;
            }
        }

        if($flag){
            break ;
        }
    }
    return $arr ;
}

var_dump(bubbleSort($sort));
