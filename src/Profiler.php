<?php 

namespace Util;

/**
 * 统计程序耗时和内存使用
 * @author windha@163.com
 */
class Profiler{
    
    /**
     * 记录时间点静态数组
     */
    public static $markTimeArr = array();

    /**
     * 标记$markName起始时间点
     * @param string $markName
     * @param float|int $timestamp
     * @return void
     */
    public static function start($markName, $timestamp = null)
    {
        self::$markTimeArr[$markName . '_start'] = $timestamp ? $timestamp : microtime(true);
    }

    /**
     * 标记$markName结束时间点
     * @param string $markName
     * @param float|int $timestamp
     * @return void
     */

    public static function end($markName, $timestamp= null)
    {
        self::$markTimeArr[$markName . '_end'] = $timestamp ? $timestamp : microtime(true);
    }

    /**
     * 获取时间耗时
     * @param string $markName
     * @param bool $isreadable
     * @param string $format
     * @return float|string|bool  默认按ms单位返回时间,保存小数点后3位
     */
    public static function getTime($markName,$isReadable = false,$format='%.3f%s')
    {
        $ret = false;
        if(isset(self::$markTimeArr[$markName.'_start']) && isset(self::$markTimeArr[$markName.'_end'])){
            $elapsedTime = self::$markTimeArr[$markName.'_end'] - self::$markTimeArr[$markName.'_start'];
            if($isReadable){
                $ret = self::readableElapsedTime($elapsedTime,$format);
            }else{
                $ret = round($elapsedTime *1000,3); 
            }
        }
        return $ret;
    }

    /**
     * 获取内存使用量
     * @param bool $isReadable
     * @param string $format
     * @return integer|string
     */
    public static function getMemoryUsage($isReadable = false,$format='%.3f%s'){
        $memoryUsage = memory_get_usage(true); 
        if($isReadable){
            $ret = self::readableMemory($memoryUsage,$format);
        }else{
            $ret = $memoryUsage;  
        }
        return $ret;
    }
    
    /**
     * 获取内存使用量峰值
     * @param bool $isReadable
     * @param string $format
     * @return integer|string
     */
    public static function getMemoryPeak($isReadable = false,$format='%.3f%s'){
        $memoryUsage = memory_get_peak_usage(true); 
        if($isReadable){
            $ret = self::readableMemory($memoryUsage,$format);
        }else{
            $ret = $memoryUsage;  
        }
        return $ret;
    }


    /**
     * 返回可读的时间
     * @param int|float $timestamp
     * @param string $format
     * @return string 
     */
    public static function readableElapsedTime($timestamp,$format)
    {
        if (is_null($format)) {
            $format = '%.3f%s';
        }
        if ($timestamp >= 1) {
            $unit = 's';
        } else {
            $unit = 'ms';
            $timestamp = $timestamp * 1000;
        }
        return sprintf($format, $timestamp, $unit);
    }

    /**
     * 返回可读的内存大小
     * @param integer $memoryUsage 
     * @param string $format
     * @return string 
     */ 
    public static function readableMemory($memoryUsage,$format)
    {
        if (is_null($format)) {
            $format = '%.3f%s';
        }
        if($memoryUsage<1024){ 
            $unit = 'B'; 
            $ret = $memoryUsage;
        }elseif($memoryUsage<1048576){ //1024*1024
            $unit = 'KB';
            $ret = $memoryUsage/1024; 
        }elseif($memoryUsage<1073741824){ //1024*1024*1024
            $unit = 'MB'; 
            $ret = $memoryUsage/1048576;
        }else{
            $unit = 'GB';
            $ret = $memoryUsage/1073741824;
        }
        return sprintf($format, $ret, $unit);
    }

}

