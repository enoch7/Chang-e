<?php
namespace app\traits;

use Yii;
trait ContainerAwareTrait
{
	/**
	 * get service name
	 * @param  [string] $name 
	 * @return [object]       [service object]
	 */
	public function get($name)
	{
		$object = Yii::$container->get($name);
		return $object;
	}
}
