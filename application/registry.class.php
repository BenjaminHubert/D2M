<?php
Class Registry {
    public $vars = [];

    public function __set($index, $value){
        $this->vars[$index] = $value;
    }

    public function __get($index){
        return $this->vars[$index];
    }
}