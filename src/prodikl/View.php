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
    /** @var string         The file to load */
    protected $file;

    /**
     * View constructor.
     * @param string $filePath
     */
    public function __construct($filePath) {
        $this->file = $filePath;
    }
    public function __set($key, $value){
        $this->values[$key] = $value;
    }
    public function render(){
        extract($this->values);
        require($this->file);
    }
}