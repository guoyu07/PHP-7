<?php
function isIp($ip)
{
    $tmp = ip2long($ip);
    if($tmp === false){
        return false ;
    }
    return true;
}

var_dump(isIp('127.0.0.1'));
var_dump(isIp('127.0.0000'));
