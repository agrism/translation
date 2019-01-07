<?php


function _c($key, $options = [], $languageCode = null)
{

    $transService = new \Paylatergroup\Translation\Services\ContentTranslationService();
    $transService->setTranslationKey($key)->setLanguageCode($languageCode);

    Translation::registerService($transService)->translate();
}

//function _i($key, $options = [], $languageCode = null)
//{
//
//    $transService = new DynamoTranslatorService();
//    $transService->setTranslationKey($key)->setLanguageCode($languageCode);
//
//
//    Translation::registerService($transService)->translate();
//}
