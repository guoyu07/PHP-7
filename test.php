<?php
    $a = array(1,2);
    $b = array(2,3,4);
    var_export($a ) ;
    var_export($b) ;
    echo "a+b = \n\n";
    var_dump($a+$b);

    echo "array_merge :\n\n" ;
    var_dump(array_merge($a ,$b));   

    echo "\n";

    $c = array('e' , 'f','p');
    $d = array('g', 'h','q');
    var_export($c );
    var_export($d);
    echo "c+d \n";
    var_dump($c+$d);
    echo "array_merge:\n";
    var_dump(array_merge($c,$d));
