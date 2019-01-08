<?php

namespace Paylatergroup\Translation;


class Translation implements ITranslation
{

    private $service;

    private static $instance;

    public function __construct()
    {
        self::$instance = $this;
    }

    private function registerService($service){

        $instance = self::getInstance();

        $this->service = $service;

        return $instance;
    }

    public function translate(){
        $this->service->translate();
    }

    public static function __callStatic($name, $args){
        $instance = self::getInstance();
        return $instance->registerService($args[0]);
    }

    private static function getInstance(){
        if(!self::$instance){
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __call($name, $args){
        $this->$name($args[0]);
    }

}