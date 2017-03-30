<?php
$test = 'aaaaa';
$abc    = &$test ;
unset($test);
echo $abc ;

var_dump($abc,$test);
?>
