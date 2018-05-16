<?php

namespace app\models;

use Yii;
use yii\base\Model;


class BaseModel extends Model
{

	public static function Test() {
		$transaction = Yii::$app->db->beginTransaction();	
		try {
			$sql = "update user set value = 120 where id = 1";
			Yii::$app->db->createCommand($sql)->execute();
			$transaction->commit();
		} catch (\Exception $e) {
			$transaction->rollback();
			throw $e;
		}
	}
	

	

}