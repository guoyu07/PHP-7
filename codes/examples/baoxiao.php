<?php
/**
 * 根据年份，月份获取工作日
 * @param   $year  
 * @param   $month 
 * @param   $days  
 * @return         
 */
function get_work_days($year , $month)
{
    //假日
    $holidays = array(
        2016 => array(
            1   => array(1) ,
            2   => array(8,9,10,11,12) ,
            4   => array(4) ,
            5   => array(2) ,
            6   => array(9,10) ,
            9   => array(15,16) ,
            10  => array(3,4,5,6,7)
        )
    ) ;
    //周末调整（工作日）
    $adjust_days = array(
        2016 => array(
            2   => array(6,14) ,
            6   => array(12) ,
            9   => array(18) ,
            10  => array(8,9) 
        )
    );
    $year_mon   = $year.str_pad($month, 2,0,STR_PAD_LEFT) ;
    $days       = date('t',strtotime($year_mon.'01')) ;
    $mon_holiday= $mon_adjust = $work_days  = array() ;
    if(isset($holidays[$year][$month])) {
        $mon_holiday = $holidays[$year][$month] ;
    }
    if(isset($adjust_days[$year][$month])) {
        $mon_adjust  = $adjust_days[$year][$month] ;
    }

    for($i = 1 ; $i <= $days ; $i++) {
        if(in_array($i , $mon_holiday)) {
            continue ;
        }
        if(date('N' ,strtotime($year_mon.str_pad($i ,2,0,STR_PAD_LEFT))) < 6 || in_array($i , $mon_adjust)) {
            $work_days[] = $i ;    
        }
    }
    return $work_days ;
}

function work_time($year , $month , $day)
{
    $word_date  = $year.'-'.str_pad($month,2,0,STR_PAD_LEFT).'-'.str_pad($day,2,0,STR_PAD_LEFT) ;
    $elapse     = rand(60,106) ;
    $work_hours = array(9,10,11) ;
    $rand_hour  = array_rand($work_hours) ;
    $start_hour = str_pad($work_hours[$rand_hour],2,0,STR_PAD_LEFT) ;
    $start_min  = str_pad(rand(5,57),2,0,STR_PAD_LEFT) ;
    $start_sec  = str_pad(rand(1,59),2,0,STR_PAD_LEFT) ;
    $end_sec    = str_pad(rand(0,59),2,0,STR_PAD_LEFT) ;
    $start_time = $word_date." $start_hour:$start_min:$start_sec" ; 
    $end_time   = date("Y-m-d H:i:{$end_sec}" , strtotime("+$elapse mins" , strtotime($start_time)) ) ;
    echo $start_time ."\t".$end_time ;
}

function home_time($year , $month , $day)
{
    $home_date  = $year.'-'.str_pad($month,2,0,STR_PAD_LEFT).'-'.str_pad($day,2,0,STR_PAD_LEFT) ;
    $elapse     = rand(60,80) ;
    $home_hour  = array(14,15,16) ;
    $rand_hour  = array_rand($home_hour) ;
    $start_hour = str_pad($home_hour[$rand_hour],2,0,STR_PAD_LEFT) ;
    $start_min  = str_pad(rand(5,57),2,0,STR_PAD_LEFT) ;
    $start_sec  = str_pad(rand(1,59),2,0,STR_PAD_LEFT) ;
    $end_sec    = str_pad(rand(0,59),2,0,STR_PAD_LEFT) ;
    $start_time = $home_date." $start_hour:$start_min:$start_sec" ; 
    $end_time   = date("Y-m-d H:i:{$end_sec}" , strtotime("+$elapse mins" , strtotime($start_time)) ) ;
    return $start_time ."\t".$end_time ;
}

function print_plan($year , $month , $count = 15)
{
    $work_days = get_work_days($year , $month) ;
    $shuffle_work_days = shuffle($work_days) ;
    $use_work_days = array_slice($work_days , 0 , $count) ;
    sort($use_work_days) ;
    foreach($use_work_days as $k => $day) {
        $rand = rand(0,100) ;
        if($rand % 2 == 0) {
            echo work_time($year , $month , $day)."\n" ;
        } else {
            echo home_time($year , $month , $day)."\n" ;
        }
    }
}

$count = 15 ;
if($argc == 3) {
    $year   = $argv[1] ;
    $month  = $argv[2] ;
}else if($argc == 2) {
    $year   = date('Y');
    $month  = $argv[1] ;
} else {
    $year   = date('Y' , strtotime('-1 month')) ;
    $month  = date('m' , strtotime('-1 month')) ;
}
print_plan($year, $month , $count) ;
