<?php
namespace app\traits;

use Yii;
use yii\data\Pagination;

trait ModelUtilTrait 
{
	public function findPageList(array $where, $cols = '*', $limit = null,$offset = null)
	{
        $query = self::find();

        $query = $this->applyWhere($query,$where);

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $list = $query->select($cols)
        	->offset($offset?$offset:$pagination->offset)
            ->limit($limit?$limit:$pagination->limit)
            ->asArray()
            ->all();

        if (!$list) {
            $list = [];
        }
        return [$list,$pagination];
	}

	public function findAllList(array $where,$cols = '*')
	{
		$query = self::find();

		$query = $this->applyWhere($query,$where);

		$list = $query->select($cols)
			->asArray()
			->all();

		if ($list) {
			return $list;
		}
		return [];
	}

	public function getOne(array $where, $cols = '*')
	{
		$query = self::find();

		$query = $this->applyWhere($query,$where);

		$model = $query->select($cols)
			->asArray()
			->one();

		if ($model) {
			return $model;
		}
		return [];
	}

	public function exist(array $where)
	{
		$query = self::find();

		$query = $this->applyWhere($query,$where);

		$result = $query->exists();
		if ($result) {
			return true;
		}
		return false;
	}


	public function add(array $data) 
	{
		$model = new self;
		$model->attributes = $data;
		if (!$model->validate()) {
			$error = array_shift($model->errors);
			return [$error[0],false];
		}
		if (!$model->save()) {
			return ['保存失败',false];
		}
		return [$model->id,true];
	}

	public function batchAdd(array $data)
	{
		$sqlAll = '';
		$tableName = static::tableName();
		foreach ($data as $each) {
			$sql = "INSERT INTO " . $tableName . "(";

			$model = new self;
			$model->attributes = $each;
			if (!$model->validate()) {
				$error = array_shift($model->errors);
				return [$error[0],false];
			}

			$keyArr = array_keys($each);
			$valueArr = array_values($each);

			$sql .= implode(',', $keyArr) . ")";

			$sql .= "VALUES('" . implode("','", $valueArr) . "');";

			$sqlAll .= $sql;
		}
		$result = Yii::$app->db->createCommand($sqlAll)->execute();
		return [null,$result];

	}

	public function edit($id, array $data)
	{
		$model = self::findOne($id);

		$className = (new \ReflectionClass($this))->getShortName();
		$loadData = [$className=>$data];
		$model->load($loadData);
		$keys = array_keys($data);
		if (!$model->validate($keys)) {
			$error = array_shift($model->errors);
			return [$error[0],false];
		}
		if (!$model->save()) {
			return ['保存失败',false];
		}
		return [null,true];

	}

	public function deleteReal($where)
	{
		return self::deleteAll($where);
	}

	public function applyWhere($query,array $where)
	{
		return $query;
	}

}