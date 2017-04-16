<?php

namespace prodikl;

/**
 * Created by Keith Larson
 * keith@prodikl.com
 */
class View
{
    /** @var  array[]       The values */
    protected $values = [];

    /** @var string         The path to the file to load */
    protected $file;

    /**
     * View constructor.
     *
     * @param string $filePath      The path to the view file to use
     */
    public function __construct($filePath) {
        $this->file = $filePath;
    }

    /**
     * Sets a value to the internal array of values.
     *
     * @param $key      mixed       The key
     * @param $value    mixed       The value
     */
    public function __set($key, $value){
        $this->values[$key] = $value;
    }

    /**
     * Renders the contents directly.
     * If any of the values are an instance of View, they are rendered and then inserted.
     */
    public function render(){
        foreach($this->values as $key => &$value){
            if($value instanceof View){
                /** @var View $value */
                $value = $value->renderAsString();
            }
        }
        extract($this->values);
        require($this->file);
    }

    /**
     * Renders the contents and returns it as a string.
     *
     * @return string
     */
    public function renderAsString(){
        extract($this->values);
        ob_start();
        require($this->file);
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->renderAsString();
    }
}