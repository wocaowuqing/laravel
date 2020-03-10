<?php
    Swoole\Runtime::enableCoroutine();
    $s = microtime(true);
    go(function () {
        for ($n = 100; $n--;) {
            usleep(1000);
            echo "侯永刚".PHP_EOL;
        }
    });
    $time_end = microtime(true);
    //相减得到运行时间
    $time = $time_end - $time_start;
    echo "这个脚本执行的时间为 $time seconds\n";
?>