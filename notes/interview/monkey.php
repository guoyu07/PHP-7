<?php
function yuesefu($n,$m) { 
    if($n<1 || $m<1){
        return -1 ;
    }
    if($n == 1){
        return 1 ;
    }
    $r=0;  
    for($i=2; $i<=$n; $i++) {
        $r=($r+$m)%$i;  
    }
    return $r+1;  
}  
echo yuesefu(100,3),"是猴王";
