<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\base\UserException;

use app\traits\ContainerAwareTrait;

/**
* 
*/
class AbstractController extends Controller
{   
    use ContainerAwareTrait;
    
    public $layout = 'main';
    public $enableCsrfValidation = false;
    
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }


	public function denyAccessUnlessGranted(array $role)
    {
        return true;
    }

    public function checkAuth($action,$id = null)
    {
    	return true;
    }

    public function beforeAction($action)
    {   
        return parent::beforeAction($action);
    }
}