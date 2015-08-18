<?php
if(!extension_loaded('extstrcat')) {
 dl('extstrcat.' . PHP_SHLIB_SUFFIX);
}
$ret=extstrcat('testarg1111',1234);
echo $ret;
?>
