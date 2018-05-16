<?php 
namespace app\controllers;
use Yii;
use Redis;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception as HttpException;
use app\models\BaseModel;
/**
* 
*/
class TestController extends AbstractController
{
	public function actionIndex()
	{
		$args = [
			'order.by',
		];
		var_dump(ArrayHelper::getValue(['order.by' => 'id asc'], 'order.by'));
	}
}