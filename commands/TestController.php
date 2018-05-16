<?php

namespace app\commands;

use yii\console\Controller;
use Redis;
use RedisException;
use yii\helpers\ArrayHelper;


class TestController extends Controller
{
    
    public $queueName = "queue";
    public $conn;

    public function actionIndex()
    {
		echo "start to handle  task\n";
		$i = 1;
		var_dump($this->conn->config('get','timeout'));
		while (true) {

			try {
				$task = $this->conn->lpop($this->queueName);
				if ($task) {
					$task = json_decode($task,true);
					$id = ArrayHelper::getValue($task, 'id');
					$content = ArrayHelper::getValue($task, 'content');
					echo "task id: " . $id . ";task content: " . $content . "\n";
				}	
			} catch (\Exception $e) {
				if ($e instanceof RedisException) {
					$this->init();
				} else {
					echo "other excepition handle\n";
					exit;	
				}
			}
			
			echo "----\n";
			sleep(10);
		}

		echo "job is done.now exit\n";
    }

    public function init()
    {
    	$redis = new Redis();
		try {
			$redis->connect('127.0.0.1');
			if ($redis->ping()) {
				echo "redis connected\n";
				$this->conn = $redis;
			}
		} catch (\Exception $e) {
			echo "Connecte to redis failed,fail message {$e->getMessage()}\n";
			exit;
		}
    }
    
}
