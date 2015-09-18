<?php 
namespace Util;

class Profiler{

    public static $profiles;
    public static $profileList;

    public static function start($name, $timestart= null)
    {
        self::$profiles[$name . 'Start'] = $timestart ? $timestart : microtime(true);
        self::$profileList[$name] = 1;
    }

    public static function end($name, $timeend= null)
    {
        self::$profiles[$name . 'End'] = $timeend ? $timeend : microtime(true);
    }

    public static function displayTime($name)
    {
        if (isset(self::$profileList[$name]))
        {
            return round((self::$profiles[$name.'End'] - self::$profiles[$name.'Start']) * 1000, 3);
        }

        return false;
    }
}

