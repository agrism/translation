<?php

use \Paylatergroup\Translation\Translation as Translation;

function _c($key, $options =[], $languageCode = null){

    $service = handleService(Translation::TYPE_CONTENT);

    $service->setTranslationKey($key)
        ->setLanguageCode($languageCode)
        ->setOptions($options)
        ->translate();
}


function _i($key, $options =[], $languageCode = null){

    $service = handleService(Translation::TYPE_INTERFACE);

    $service->setTranslationKey($key)
        ->setLanguageCode($languageCode)
        ->setOptions($options)
        ->translate();
}

function handleService($type){
    $services = Translation::getServices();

    if(!isset($services[$type])){
        throw new Exception('Register service before use :'.$type);
    }

    return $services[$type];
}
