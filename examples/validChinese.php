<?php
function isChinese($data) {
    return preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z_]+$/u", $data);
}

var_dump(isChinese('垚'));

