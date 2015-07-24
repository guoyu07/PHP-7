<?php
$data = array(); 
$data[] = array('uid' => 1, 'ctime' => 12 ,'name'=>'aa'); 
$data[] = array('uid' => 6, 'ctime' => 23,'name'=>'qq'); 
$data[] = array('uid' => 7, 'ctime' => 23); 
$data[] = array('uid' => 8, 'ctime' => 45); 
$data[] = array('uid' => 9, 'ctime' => 56); 
$data[] = array('uid' => 3, 'ctime' => 89,'name'=> 'adsa'); 

// 取得列的列表 
foreach ($data as $key => $row) 
{ 
        $volume[$key]  = $row['uid']; 
        $edition[$key] = $row['ctime']; 
} 

array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data); 

print_r($data);
