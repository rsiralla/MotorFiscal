<?php

namespace MotorFiscal;

/**
 * Classe base para ocultar campos privados
 */
class Base
{
    protected $externalProp = array();
    public $customInfo = array();

    public function assign($obj)
    {
        foreach ($this->externalProp as $property) {
            if (property_exists($this, $property) && property_exists($obj, $property)) {
                $this->$property = $obj->$property;
            }
        }
    }

    public function __setAll($obj)
    {
        foreach ($obj as $key => $value) {
            $this->__set($key, $value);
        }
    }

    public function __set($name, $value)
    {

        if (property_exists($this, $name)) {
            return $this->$name = $value;
        } else {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'], E_USER_NOTICE);
            return null;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'], E_USER_NOTICE);
            return null;
        }
    }

}
