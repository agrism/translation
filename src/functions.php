<?php

use \Paylatergroup\Translation\Translation as Translation;

function _c($key, $options =[], $languageCode = null){

    $service = Translation::getServices()[Translation::TYPE_CONTENT];

    $service->setTranslationKey($key)
        ->setLanguageCode($languageCode)
        ->setOptions($options)
        ->translate();
}


function _i($key, $options =[], $languageCode = null){

    $service = Translation::getServices()[Translation::TYPE_INTERFACE];

    $service->setTranslationKey($key)
        ->setLanguageCode($languageCode)
        ->setOptions($options)
        ->translate();
}
