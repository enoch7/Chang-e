<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use common\RedisLocker;
/**
* 
*/
class DemoController extends Controller
{
	
	public function actionIndex()
	{
		//yii-redis
		$redis = Yii::$app->get('redis');

		// $re = $redis->sunionstore('test-1', 'test-2');
		$re = $redis->incrby('test', 2);
		var_dump($re);
		// $result = $redis->hgetall('test-hash');
		// var_dump($result);
		// echo '<hr>';
		// $redis = \Yii::$app->get('redis-haha');
		// $result = $redis->hgetall('test-hash');
		// var_dump($result);		


		return;
		//redis C extension
		$redis = \Yii::$app->get('redis-haha');

		// $redis->hMSet('test-hash', ['key1' => 'value1', 'key2' => 'value2']);

		// $result = $redis->hGetAll('test-hash');
		
		// $result = $redis->getOption(\Redis::OPT_SERIALIZER);
		$args = ['test', 'test1'];
		array_unshift($args, 'test-d');
		array_unshift($args, 'AND');
		$result = call_user_func_array(array($redis, 'bitOp'), $args);
		var_dump($result);
		// var_dump($result);

		// echo "dd";
	}

	public function actionTest()
	{
		$redis = new \Redis();
		$redis->connect('127.0.0.1','6379');
		$redis->auth('1');
		$locker = new RedisLocker($redis);

		$result = $locker->lock('mylock', 10, 10);
		var_dump($result);
	}
}