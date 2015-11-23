<?php
set_time_limit(0);
ini_set('default_socket_timeout', -1);
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$i=0 ;
while(true)
{
    try {
        $content = $redis->brpop('myqueue',0);
        var_dump($content);
        sleep(2);
    } catch (Exception $e) {
        echo $e->getMessage()."\n" ;
        break ;
    }
}

?>
