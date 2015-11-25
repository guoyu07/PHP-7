<?php
include "logfile.php" ;
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
