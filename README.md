##统计时间耗时和内存使用类

###usage:
#### composer.json 内容如下
    {
        "require": {
            "windha/profiler":"dev-master"
        },
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/windha/profiler"
            },
            {
                "packagist": false
            } 
        ]
    }

###examples:

    \Util\Profiler::start("bs");
    sleep(1);
    \Util\Profiler::end("bs");
    echo \Util\Profiler::getTime("bs")."\n"; //1000.109
    echo \Util\Profiler::getTime("bs",true)."\n"; //1.000s

    \Util\Profiler::start("cs");
    usleep(10000);
    \Util\Profiler::end("cs");
    echo \Util\Profiler::getTime("cs")."\n"; //10.079
    echo \Util\Profiler::getTime("cs",true)."\n";//10.079ms
    echo \Util\Profiler::getTime("cs",true,"cost:%.2f%s")."\n"; //cost:10.08ms


    echo \Util\Profiler::getMemoryUsage()."\n"; //524288
    echo \Util\Profiler::getMemoryUsage(true)."\n"; //512.000KB
    echo \Util\Profiler::getMemoryUsage(true,'memoryusage:%.2f%s')."\n"; //memoryusage:512.00KB

    echo \Util\Profiler::getMemoryPeak()."\n"; //524288
    echo \Util\Profiler::getMemoryPeak(true)."\n";//512.000KB
    echo \Util\Profiler::getMemoryPeak(true,'memorypeak:%.2f%s')."\n";//memorypeak:512.00KB


    $arr = array();
    for($i = 1;$i<100000;++$i){
        $arr[] = $i; 
    }

    echo \Util\Profiler::getMemoryUsage()."\n"; //15204352
    echo \Util\Profiler::getMemoryUsage(true)."\n";//14.500MB
    echo \Util\Profiler::getMemoryUsage(true,'memoryusage:%.2f%s')."\n"; //memoryusage:14.50MB

    echo \Util\Profiler::getMemoryPeak()."\n"; //15204352
    echo \Util\Profiler::getMemoryPeak(true)."\n"; //14.500MB
    echo \Util\Profiler::getMemoryPeak(true,'memorypeak:%.2f%s')."\n";//memorypeak:14.50MB

