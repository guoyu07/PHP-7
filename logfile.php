<?php
/**
 * 日志类文件
 *
 * @desc 用文件记录程序运行过程产生的日志
 * @author zaifeng
 * @date 2015-11-25
 */
class LogFile 
{
    public static $switcher     = true ;   //开关
    public static $sync_flag    = false ;    //日志同步写标识
    public static $max_retry    = 3 ;       //写失败尝试次数
    public static $single_flag  = true ;    //单文件日志标识

    public static $log_tpl      = "[%s]\t%s\t%s\t%s\r\n" ;  //日志格式文件
    public static $log_level    = array('info','debug','notice','warn','error') ; //日志级别
    public static $cache_max    = 100 ;     //日志缓存最大记录数，超过后写文件
    public static $level_logs   = array() ;
    private static $log_path    = '/' ;
    
    /**
     * 根据级别获取日志
     * @param  string $level [description]
     * @return mixed
     */
    private static function get_logs($level = 'default')
    {
        return self::$level_logs[$level] ;
    }

    private static function add_logs($log , $level = 'default')
    {
        return self::$level_logs[$level][] = $log ;
    }

    private static function set_logs($log , $level = 'default')
    {
        return self::$level_logs[$level] = $log ;
    }

    public static function write($log , $level='default')
    {
        if(self::$switcher) 
        {
            self::add_logs($log , $level) ;
            $log_file = self::log_file_name($level) ;
            if(self::$sync_flag) //同步写
            {
                $logs = self::get_logs($level) ;
                if(self::write_log($log_file , $logs ) ){
                    unset(self::$level_logs[$level]) ;    
                }
            } 
            else //异步写
            {
                if(count(self::$level_logs[$level] ) >= self::$cache_max) 
                {
                    $w_log = array_slice(self::$level_logs[$level], 0 , self::$cache_max) ;
                    if(self::write_log($w_log , $level))
                    {
                        $left_log = array_slice(self::$level_logs[$level], self::$cache_max) ;    
                        self::set_logs($left_log , $level) ;
                    }
                }
            }
        }
        return true ;
    }

    /**
     * 写日志
     * @param  string   $level 日志级别
     * @param  mixed    $log   日志内容
     * @return bool     true / false
     */
    private static function write_log($log_file , $logs)
    {
        try 
        {
            $handle = fopen(self::$log_path . $log_file, 'a+') ;
            if (flock($handle, LOCK_EX)) 
            {
                foreach($logs as $log) 
                {
                    $times = self::$max_retry ;
                    while($times--) //尝试3次
                    {
                        $result = fwrite($handle, $log);
                        if($result) {
                            break ;
                        }
                    }
                    if($times == 0) {
                        //mail to admin
                    }
                }
                flock($handle, LOCK_UN);
                fclose($handle) ;
            }

        }
        catch(Excepthon $e) 
        {
            @fclose($handle) ;
            // mail to admin
        }

        return true ;
    }

    public static function info($log)
    {
        $log_txt = sprintf(self::$log_tpl , date('Y-m-d H:i:s') , '127.0.0.1' , 'info' , $log) ;
        self::write($log_txt , 'info') ;
    }

    public static function notice($log)
    {
        $log_txt = sprintf(self::$log_tpl , date('Y-m-d H:i:s') , '127.0.0.1' , 'notice' , $log) ;
        self::write($log_txt , 'notice') ;
    }

    public static function warn($log)
    {
        $log_txt = sprintf(self::$log_tpl , date('Y-m-d H:i:s') , '127.0.0.1' , 'warning' , $log) ;
        self::write($log_txt , 'warn') ;
    }

    public static function debug($log)
    {
        $log_txt = sprintf(self::$log_tpl , date('Y-m-d H:i:s') , '127.0.0.1' , 'debug' , $log) ;
        self::write($log_txt , 'debug') ;
    }

    public static function error($log)
    {
        $log_txt = sprintf(self::$log_tpl , date('Y-m-d H:i:s') , '127.0.0.1' , 'error' , $log) ;
        self::write($log_txt , 'error') ;
    }

    /**
     * 获取日志文件
     * @param  string $level 日志级别
     * @return string
     */
    private static function log_file_name($level)
    {
        if(self::$single_flag)  //日志单文件存储
        {
            return date('YmdH')."all.log" ;
        }
        if(in_array($level, self::$log_level)) 
        {
            return date('YmdH').strtolower($level).".log" ;
        }
        else
        {
            return date('YmdH')."all.log" ;
        }
    }

    public static function shutdown_func() 
    {
        if(!empty(LogFile::$level_logs)) 
        {
            foreach(LogFile::$level_logs as $level => $logs)
            {
                if(!empty($logs)) 
                {
                    $log_file = self::log_file_name($level) ;
                    self::write_log($log_file , $logs) ;
                }
            }
        }
    }

}
