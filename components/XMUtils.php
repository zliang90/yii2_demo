<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-7-17
 * Time: 上午10:18
 */


namespace app\components;

use yii\web\MethodNotAllowedHttpException;

class XMUtils
{
    /**
     * @var array  可用的http method列表
     */
    public static $http_methods = ["get", "post", "head", "put", "delete"];

    /**
     *
     * 发送HTTP请求
     *
     * @param $url
     * @param string $method
     * @param null $header
     * @param null $data
     * @param int $timeout
     * @return array
     * @throws MethodNotAllowedHttpException
     */
    public static function HttpRequest($url, $method = '', $header = null, $data = null, $timeout = 30)
    {
        $method = !empty($method) ? strtolower($method) : 'get';

        if (!in_array($method, self::$http_methods)) {
            throw new MethodNotAllowedHttpException("Method Not Allowed.");
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);      //获取内容url
        curl_setopt($curl, CURLOPT_HEADER, false);  //获取http头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//返回数据流，不直接输出
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);  //超时时长，单位秒

        if (!empty($header) && is_array($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }

        // 判断请求类型
        switch ($method) {
            case "post":
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "put":
                curl_setopt($curl, CURLOPT_PUT, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
        }

        $result = [];

        try {
            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $result['status'] = $status;
            $result['data'] = trim($data);
        } catch (Exception $e) {
            $result['message'] = $e->getMessage();
        } finally {
            curl_close($curl);
        }

        return $result;
    }
}