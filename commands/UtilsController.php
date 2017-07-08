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
        $str = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rand_pass = '';
        for ($i = 0; $i < $length; $i++) {
            $rand_pass .= $str[mt_rand(0, strlen($str) - 1)];
        }

        echo $rand_pass;
    }

    public function actionHttpRequest($url, $method = '', $data = '', $timeout = 30)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);      //获取内容url
        curl_setopt($curl, CURLOPT_HEADER, false);  //获取http头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//返回数据流，不直接输出
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);  //超时时长，单位秒

        // 判断请求类型
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json; charset=utf-8',
                        'Content-Length: ' . strlen($data))
                );

                if (!empty($data)) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, true);
                break;
        }


        $result = [];

        try {
            $result['data'] = trim(curl_exec($curl));
            $result['status'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        } finally {
            curl_close($curl);
        }

        echo json_encode($result);
    }

}