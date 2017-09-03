<?php
namespace app\traits;

trait ModelUtilTrait 
{
	public function findPageList(array $where,$cols = '*')
	{
        $query = self::find();

        $query = $this->applyWhere($query,$where);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);
        $list = $query->select($cols)
        	->offset($pagination->offset)
            ->limit($pagination->limit)
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

	public function edit($id, array $data)
	{
		$model = new self;
		$model->load($data);
		$keys = array_keys($data)
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