<?php
    echo YAF_VERSION,YAF_ENVIRON,"\n";
    $arr = array("aabcc" => "Hello world");
    var_dump(http_build_query($arr,'','',PHP_QUERY_RFC3986));
