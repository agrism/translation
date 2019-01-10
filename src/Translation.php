<?php

namespace Paylatergroup\Translation;


class Translation
{

    const TYPE_INTERFACE = '_i';
    const TYPE_CONTENT = '_c';

    private static $services = [];

    private function __construct()
    {
    }

    public static function initService($type, ITranslation $service)
    {
        self::$services[$type] = $service;
    }

    public static function getServices()
    {
        return self::$services;
    }

    public static function setLanguageCode($type, $code)
    {
        if(isset(self::$services[$type])){
            self::$services[$type]->setLanguageCode($code);
        }
    }
}