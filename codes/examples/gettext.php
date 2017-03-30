<?php
class Com_Code {
    public function pr(){
        $a = array('ab' => _('test'));
        var_dump($a) ;
    }
}
$test = new Com_Code();
$test->pr();
