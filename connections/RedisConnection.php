<?php
namespace app\connections;

use yii\base\Object;
/**
* 
*/
class RedisConnection extends Object
{
	public $hostname = '127.0.0.1';

	public $port = 6379;

	public $database = 0;

	public $password;

	public $timeout = 5;

	static $db;

	public function __construct($config = [])
	{
		parent::__construct($config);
	}

	public function connect()
	{
		$redis = new \Redis;

		if (!$redis->connect($this->hostname, $this->port, $this->timeout, null, 100)) {
			throw new \Exception("failed to connect with redis server");
		}
		
		$redis->select($this->database);

		if ($this->password) {
			$redis->auth($this->password);
		}
		static::$db = $redis;
	}

	public function __call($method, $args)
    {
    	if (static::$db === null) {
    		$this->connect();
    	}

        return call_user_func_array(array(static::$db, $method), $args);
    }
}