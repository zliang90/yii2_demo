<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

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
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $rand_pass = '';
        for ($i = 0; $i < $length; $i++) {
            $rand_pass .= $str[mt_rand(0, strlen($str) - 1)];
        }

        echo $rand_pass;
    }

}