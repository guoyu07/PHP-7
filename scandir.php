<?php
if($_SERVER['argc'] < 2){
    exit("Please input a path\n");
}
$dir = $_SERVER['argv'][1] ;
if(!is_dir($dir)) {
    exit('wrong path input');
}
$files1 = scandir($dir);
$files2 = scandir($dir, 1);

print_r($files1);
print_r($files2);
?> 
