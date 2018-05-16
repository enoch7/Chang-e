<?php
namespace app\models;

use yii\base\Model;
use yii\base\Event;
use yii\base\Behavior;

/**
* 
*/
class HahaModel extends Model
{
	const EVENT_AFTER = 'after';

	public $name;

	public $age;

	public function init() {
		parent::init();

		$this->on(self::EVENT_AFTER, [$this, 'afterSomething'], 'tess');
	}

	public function afterSomething($event)
	{
		$sender = $event->sender;
		var_dump($sender);
	}

}