<?php
/**
 * Deal
 */

define('PROCESS_CNT' , 10);
define('TIMEOUT' , 4) ;
define('TS' , 4);

define('TABLE_PREFIX' , 'lcd_file_');
if(!extension_loaded('pcntl')) {
    exit('pcntl extension not installed or not loaded');
}

for($i = 0 ; $i<100 ;$i++) {
    echo TABLE_PREFIX.str_pad($i , 1 , 0 , STR_PAD_LEFT) ."\n";
}

function dealing($order_count)
{
    echo $order_count ."\n";
}
