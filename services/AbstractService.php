<?php
namespace app\services;

use Yii;
use yii\base\UserException;
use app\traits\ContainerAwareTrait;

abstract class AbstractService
{
	use ContainerAwareTrait;

	private $_requestCacheList = [];

    private $_cacheCom;

    public function __construct()
    {   
        $this->_cacheCom = Yii::$app->cache;
    }

	public function getRequestCache($key)
	{
		if (isset($this->_requestCacheList[$key])) {
	        $result = $this->_requestCacheList[$key];

	        if (is_object($result)) {
	            $result = clone $result;
	        } elseif (is_resource($result)) {
	            $result = null;
	        }
	        return $result;
        }

	}

	public function setRequestCache($key , $value)
	{
		if (is_object($value)) {
            $value = clone $value;
        } elseif (is_resource($value)) {
            $value = null;
        }

        $this->_requestCacheList[$key] = $value;

        return $this;

	}

	
    /**
     * unset掉请求周期缓存
     */
    protected function unsetRequestCache($key)
    {
        unset($this->_requestCacheList[$key]);

        return $this;
    }

    protected function clearRequestCache()
    {
        $this->_requestCacheList = array();
    }

    public function getCacheCom()
    {
        return $this->_cacheCom;
    }


    public function getFileCache($key)
    {
        return $this->getCacheCom()->get($key);
    }
    /**
     * 保存文件缓存
     */
    protected function setFileCache($key,$value)
    {
        $cache = $this->getCacheCom();
        $cache->set($key,$value);

        return $cache;
    }

    /**
     * unset文件缓存
     */
    protected function unsetFileCache($key)
    {
        $cache = $this->getCacheCom();
        $cache->delete($key);
    }

}