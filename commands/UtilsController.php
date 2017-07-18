<?php

namespace app\commands;

use yii\console\Controller;
use app\components\XMUtils;

class UtilsController extends Controller
{

    /**
     * 从ASCII码表随机生成指定长度字符串
     * @param int $length
     */
    public function actionRandStr($length = 8)
    {
        $rand_pass = '';
        for ($i = 0; $i < $length; $i++) {
            $rand_pass .= chr(mt_rand(33, 126));        //ascii ! --- ~
        }

        echo $rand_pass;
    }

    /**
     * 从a-zA-Z0-9中随机生成指定长度字符串
     * @param int $length
     */
    public function actionRandStr2($length = 8)
    {
        $str = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_pass = '';
        for ($i = 0; $i < $length; $i++) {
            $rand_pass .= $str[mt_rand(0, strlen($str) - 1)];
        }

        echo $rand_pass;
    }

    public function actionHttpTest()
    {
//        $result = XMUtils::HttpRequest("https://api.myjson.com/bins/ckjuf");
//        $result = XMUtils::HttpRequest("http://127.0.0.1:8080/api/v1/members", 'put');
        $result = XMUtils::HttpRequest("http://127.0.0.1:8080/api/v1/hello", 'post', [
            "Content-Type" => "application/x-www-form-urlencoded"
        ], [
            "username" => "shark"
        ]);

        var_dump($result);
    }

}