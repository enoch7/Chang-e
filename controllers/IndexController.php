<?php
namespace app\controllers;

use Yii;
use app\models\HahaModel;
use yii\base\ErrorException;
use yii\base\Event;
use work\TestName;
use yii\db\Query;
/**
* 
*/
class IndexController extends AbstractController
{
	// public $layout = false;
	
	public function actionIndex()
	{

		// $query = (new Query())->select('*')->from(['user','post'])->createCommand();
		// echo $query->sql;


		// $obj = new TestName();
		// $obj->hello();

		// $model = new HahaModel;

		// $model->attributes =   ['name'=>'xiaom', 'age'=>26];

		// var_dump($model->name);

		// var_dump($model->attributes);
		try {
			// $data = ['test'=>1];
			// echo $data['hh'];
		} catch (\Exception $e) {
			// echo "catched:".$e->getMessage();
			return ;
		}
		// \Yii::error("test log");

		return $this->render('index');
		
	}

	public function actionTest()
	{
		$model = new HahaModel();
		$model->age = 27;
		$model->trigger(HahaModel::EVENT_AFTER,new Event());
	}

	public function actionTest1()
	{
		$form = new \app\models\TestForm;

		$form->username = 'hha';
		var_dump($form->validate());
	}

	public function actionTest2()
	{
		$model = new HahaModel;
		$this->aa($model);
		var_dump($model);

	}

	private function aa($obj)
	{
		$obj->age = 299;
	}

}