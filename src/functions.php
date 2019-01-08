<?php


function _c($key, $options = [], $languageCode = null)
{
    try {


        $configPath = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . 'config.php';

        if (file_exists($configPath)) {
            $config = include($configPath);
        }

        if (empty($config['PDO'])) {
            throw new Exception('PDO is required!');
        }

        if (isset($config['CONTENT_SERVICE'])
            && in_array('Paylatergroup\Translation\ITranslation', class_implements($config['CONTENT_SERVICE']))
        ) {
            $transService = new $config['CONTENT_SERVICE'];
        } else {
            $transService = new \Paylatergroup\Translation\Services\ContentTranslationService();
        }

        $transService->setConnection($config['PDO'])
            ->setTranslationKey($key)
            ->setLanguageCode($languageCode);

        \Paylatergroup\Translation\Translation::registerService($transService)
            ->translate();
    } Catch (Exception $e) {
        var_dump($e->getMessage());
    }
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
