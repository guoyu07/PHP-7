<?php
function asdf() {
     echo microtime(true) . '<br>';
     sleep(1);
     echo microtime(true) . '<br>';
     sleep(1);
     echo microtime(true) . '<br>';
 }

register_shutdown_function('asdf');
try
{
    echo "Hello"
}
catch(Exception $e){
   echo $e->getMessage();
}
set_time_limit(1);

exit;
LogFile::info('test1');
LogFile::info('test2');
LogFile::info('test3');
LogFile::info('test4');
LogFile::info('test5');
LogFile::info('test6');
LogFile::info('test7');
LogFile::info('test8');
LogFile::info('test9');
register_shutdown_function(array('LogFile','shutdown_func') ) ; 
