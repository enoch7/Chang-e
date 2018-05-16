<?php
namespace app\controllers;
use Yii;
use Redis;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception as HttpException;
/**
* 
*/
class HelloController extends AbstractController
{
	public function actionIndex()
	{
		// $redis->set('exp', 20, ['Nx', 'ex' => 10]);
		// $helloService = $this->get('service.hello');
		// $helloService->sayHello();

		// try {
		// 	// $request = (new Client(['baseUrl'=> 'http://localhost']))->createRequest();
		// 	// $request
		// 			// ->setFormat(Client::FORMAT_JSON)
		// 			->setFormat(Client::FORMAT_URLENCODED)
		// 			->setData(['name1'=>'value1'])
		// 			->setMethod('post');
		// 	$response = $request->send();
		// 	var_dump($response->getContent());	
		// } catch (HttpException $e) {
		// 	echo "get Exception";
		// }
		
		// $transaction = Yii::$app->db->beginTransaction();
		try {
			// $sql = "insert into user(value,name,create_at) values(122,'testt',2)";
			// Yii::$app->db->createCommand($sql)->execute();

			// $transaction->commit();

			throw new \Exception("Error Processing Request", 1);
			
		} catch (\Exception $e) {
			Yii::error($e);
			// $transaction->rollback();
			echo $e->getMessage();
		}

	}

	public function actionSendtask()
	{
		try {
			$redis = new Redis();
			$redis->connect('127.0.0.1');
			$i = 1;
			if ($redis->ping()) {
				$redis->lpush('queue',json_encode(['id'=>$i,'content'=>"say hi"]));
				echo "have push";
			}
		} catch (\Exception $e) {
			echo get_class($e);
		}
		

	}
}