<?php
$m = new Memcached();

$servers = array(
    array('localhost', 11212, 33),
    array('localhost', 11211, 67)
);
$m->addServers($servers);

$m->set('counter', 0);
$m->increment('counter');
$m->increment('counter', 10);
var_dump($m->get('counter'));

$m->set('key', 'abc');
$m->increment('counter');
?>
