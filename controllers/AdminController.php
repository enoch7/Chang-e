<?php
namespace app\controllers;
use Yii;
/**
* 
*/
class AdminController extends AbstractController
{
	public function actionTest()
	{
		$redis = Yii::$app->redis;
		$redis->set('exp', 10, ['Nx', 'ex' => 10]);

		$redis->set('exp', 20, ['Nx', 'ex' => 10]);
	}

	public function actionIndex()
	{
		$call = \Yii::$app->request->get('callback');

		$str = $this->render()
	}
	
}