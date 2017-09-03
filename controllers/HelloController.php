<?php
namespace app\controllers;

/**
* 
*/
class HelloController extends AbstractController
{
	public function actionIndex()
	{
		$helloService = $this->get('service.hello');
		$helloService->sayHello();
	}
}