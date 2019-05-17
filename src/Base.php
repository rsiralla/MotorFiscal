<?php

namespace MotorFiscal;

/**
 * Classe base para ocultar campos privados.
 */
class Base
{
    /**
     * @var array
     */
    public $customInfo = [];

    /**
     * @var array
     */
    protected $externalProp = [];

    /**
     * @param $obj
     */
    public function assign($obj)
    {
        foreach ($this->externalProp as $property) {
            if (property_exists($this, $property) && property_exists($obj, $property)) {
                $this->$property = $obj->$property;
            }
        }
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            $trace = debug_backtrace();
            trigger_error('Undefined property via __get(): '.$name.' in '.$trace[0]['file'].' on line '
                          .$trace[0]['line'], E_USER_NOTICE);
        }
    }

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            return $this->$name = $value;
        } else {
            $trace = debug_backtrace();
            trigger_error('Undefined property via __get(): '.$name.' in '.$trace[0]['file'].' on line '
                          .$trace[0]['line'], E_USER_NOTICE);
        }
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return property_exists($this, $name);
    }

    protected function toFloat($value)
    {
        return is_numeric($value)
            ? str_replace(',', '', $value)
            : 0;
    }
}
