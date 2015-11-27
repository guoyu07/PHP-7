<?php
//set_time_limit(0);
//ini_set('default_socket_timeout', -1);
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
//$result = $redis->hmget('share:info:1',array('ttt','qqq'));
//$result = $redis->del('share:info:1');
//$result = $redis->hmset('share:info:1',array('a'=>'qqq','b'=>'ttt'));
$result = $redis->sort('share:from:1' , array(
'by' => 'share:info:*->uid',
'limit' => array(0, 100),
//'get' => array("#",'share:info:*->uid' ,'share:info:*->to_uid'),
'sort' => 'desc',
'alpha' => TRUE
)) ;
foreach($result as $sid ){
    $info_key = 'share:info:'.$sid ;
    $info   = $redis->hgetall($info_key) ;
    var_dump($info);
}
var_dump($result);
?>
