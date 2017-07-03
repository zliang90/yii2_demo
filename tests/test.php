<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/26 026
 * Time: 14:40
 */

echo 'PHP_VERSION = ' . PHP_VERSION . PHP_EOL;
echo 'PHP_MAJOR_VERSION = ' . PHP_MAJOR_VERSION . PHP_EOL;
echo 'PHP_MINOR_VERSION = ' . PHP_MINOR_VERSION . PHP_EOL;
echo 'PHP_RELEASE_VERSION = ' . PHP_RELEASE_VERSION . PHP_EOL;
echo 'PHP_VERSION_ID = ' . PHP_VERSION_ID . PHP_EOL;
echo 'PATH_SEPARATOR = ' . PATH_SEPARATOR . PHP_EOL;



function generateKey($key) {
    if (is_string($key)) {
        $key = ctype_alnum($key) && strlen($key) <= 5 ? $key : substr(md5($key), 0, 5);
    } else {
        // 生成key
        $key = substr(md5(json_encode($key)), 0, 5);
    }

    return $key;
}

echo generateKey("demo");