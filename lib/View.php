<?php
namespace FMUP;

use FMUP\Exception\UnexpectedValue;

/**
 * Class View
 * /!\ Beware this version is not compliant with FMU View since layout are hardcoded.
 * With FMUP\View you'll be able to inject Views to views
 *
 * @package FMUP
 */
class View
{
    private $viewPath;
    private $params = array();

    /**
     * @param array $params
     */
    public function __construct(array $params = array())
    {
        $this->addParams((array)$params);
    }

    /**
     * @param array $params
     * @return $this
     */
    public function addParams(array $params = array())
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws UnexpectedValue
     * @return $this
     */
    public function setParam($name, $value)
    {
        if(!is_string($name)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_TYPE_NOT_STRING, UnexpectedValue::CODE_TYPE_NOT_STRING);
        }
        if(empty($name)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_VALUE_EMPTY, UnexpectedValue::CODE_VALUE_EMPTY);
        }
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     * @throws UnexpectedValue
     * @return mixed
     */
    public function getParam($name)
    {
        if(!is_string($name)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_TYPE_NOT_STRING, UnexpectedValue::CODE_TYPE_NOT_STRING);
        }
        if(empty($name)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_VALUE_EMPTY, UnexpectedValue::CODE_VALUE_EMPTY);
        }
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     * @throws UnexpectedValue
     */
    public function render()
    {
        if (is_null($this->getViewPath())) {
            throw new UnexpectedValue('View must be defined', UnexpectedValue::CODE_VALUE_NULL);
        }
        if (!file_exists($this->getViewPath())) {
            throw new UnexpectedValue('File does not exist', UnexpectedValue::CODE_VALUE_INVALID_FILEPATH);
        }
        ob_start();
        $vars = $this->getParams();
        extract($vars); //for compliance only - @todo remove this line
        require($this->getViewPath());
        return ob_get_clean();
    }

    /**
     * Define view to use
     * @param string $viewPath Full path to view
     * @throws UnexpectedValue
     * @return $this
     */
    public function setViewPath($viewPath)
    {
        if(!is_string($viewPath)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_TYPE_NOT_STRING, UnexpectedValue::CODE_TYPE_NOT_STRING);
        }
        if(empty($viewPath)) {
            throw new UnexpectedValue(UnexpectedValue::MESSAGE_VALUE_EMPTY, UnexpectedValue::CODE_VALUE_EMPTY);
        }

        $this->viewPath = $viewPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * Implements object use
     * @param string $param
     * @return mixed
     */
    public function __get($param)
    {
        return $this->getParam($param);
    }

    /**
     * Implements object use
     * @param string $param
     * @param mixed $value
     * @return View
     */
    public function __set($param, $value)
    {
        return $this->setParam($param, $param);
    }
}
