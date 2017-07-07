<?php
/**
 * https://github.com/nicolasff/phpredis
 */
namespace app\components;
use yii\base\Component;
use redis;

interface IRedis
{
    /**
     * Retrieves a value from cache with a specified key.
     * @param string $id a key identifying the cached value
     * @return mixed the value stored in cache, false if the value is not in the cache or expired.
     */
    public function get($id);
    public function mget(array $ids);
    public function set($key,$val,$ttl=0);
    public function hSet($key ,$hashKey ,$value);
    public function hGet($key ,$hashKey );
    public function hLen($key);
    public function hDel($key,$hashKey);
    public function hKeys($key);
    public function delete($key);
    public function deleteKeys($keys);//array
    public function hVals($key);
    public function hGetAll($key);
    public function hExists($key,$hashKey);
    public function setTimeout($key, $ttl);
    public function rename($key1,$key2);
    public function keys($key);
}


class XMRedis extends Component implements IRedis {
    public $enable = false;
    public $timeout = 5;
    public $_redis;
    public $host;
    public $port;
    public $db;
    public $auth;
    public $is_serializer = true;//是否序列化

    public function  init() {
        $this->getRedis();
    }

    public function getRedis()
    {
        try {
            $this->_redis = new Redis();
            $this->_redis->connect($this->host, $this->port, $this->timeout);

            if (isset($this->auth) && !empty($this->auth)) {
                $this->_redis->auth($this->auth);
            }
            if($this->is_serializer)
                $this->_redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
            if ($this->db)$this->_redis->select($this->db);
            return $this->_redis;
        } catch (RedisException $e) {
            throw new CHttpException(400, "Redis occurs an error:" . $e->getMessage());
        }
    }

    public function set($key,$val,$ttl=0){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return  $ttl?$this->_redis->setex($key, $ttl, $val):$this->_redis->set($key,$val);


    }

    public function get($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->get($key);
    }

    public function mget(array $keys){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        $redis_mget_key_array = $keys;
        return $this->_redis->mget($redis_mget_key_array);
    }

    public function hSet($key ,$hashKey ,$value){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hSet($key, $hashKey, $value);

    }

    public function hGet($key ,$hashKey ){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hGet($key, $hashKey);

    }
    public function hLen($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hLen($key);
    }

    public function hDel($key,$hashKey){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hDel($key,$hashKey);
    }

    public function hKeys($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hKeys($key);
    }
    public function hVals($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hVals($key);
    }
    public function delete($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->delete($key);
    }

    public function deleteKeys($keys){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->delete($keys);
    }

    public function hGetAll($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hGetAll($key);
    }

    public function hExists($key,$hashKey){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->hExists($key,$hashKey);

    }
    public function setTimeout($key,$ttl){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->setTimeout($key,$ttl);

    }

    public function rename($key1,$key2){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->rename($key1,$key2);

    }
    public function keys($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->keys($key);
    }

    /**
     * 在列表尾加一个元素
     */
    public function rPush($key , $e){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->rPush($key,$e);
    }
    /**
     * 在列表尾加一个元素
     */
    public function rPushx($key , $e){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->rPushx($key,$e);
    }
    /**
     * 删除并返回列表头一个元素
     */
    public function lPop($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lPop($key);
    }
    /**
     *返回列表头一个元素
     */
    public function lGet($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lGet($key,0);
    }
    /**
     *返回列表元素个数
     */
    public function lSize($key){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lSize($key);
    }
    /**
     *删除列表中的value为$e的元素
     */
    public function lRem($key , $e){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lRemove($key , $e ,0);
    }
    /**
     * 队列表修剪
     */
    public function lTrim($key , $start , $end){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lTrim($key , $start ,$end);
    }
    /**
     *返回指定区间元素
     */
    public function lRange($key , $start , $end){
        try{
            $this->ping();
        }  catch (RedisException $e){
            self::getRedis();
        }
        return $this->_redis->lRange($key , $start ,$end);
    }

    public function ping() {
        $this->_redis->ping();
    }
}
?>
