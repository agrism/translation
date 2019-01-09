<?php

namespace Paylatergroup\Translation\services;


use Paylatergroup\Translation\ITranslation;

class MysqlService implements ITranslation
{
    private $languageCode;

    private $translationKey;

    private $options = [];

    private $translation = '';

    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function translate($type = null)
    {
        $this->getData()->replaceOptions();

        $translation = $this->translationKey;

        if (empty($this->translation->translation)) {

            if (empty($this->translation->text)) {

                $this->insertNewData();

            } else {

                $translation = $this->translation->text;
            }
        } else {

            $translation = $this->translation->translation;
        }

        echo $translation;
    }

    public function setLanguageCode($code)
    {
        if(!empty($code)){
            $this->languageCode = $code;
        }

        return $this;
    }

    public function setTranslationKey($translationKey)
    {
        $this->translationKey = $translationKey;
        return $this;
    }

    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    private function getData()
    {

        $query = '
            SELECT * FROM translations t
            LEFT JOIN translations_data td 
              ON  t.id = td.translation_id
              AND td.language_code = :language_code
            WHERE t.text = :key
        ';

        $data = $this->pdo->prepare($query);

        $data->execute([
            ':language_code' => $this->languageCode,
            ':key' => $this->translationKey,
        ]);

        $this->translation = $data->fetchObject();

        return $this;
    }

    private function replaceOptions()
    {
        if(empty($this->translation->options)){
            return $this;
        }
        foreach (json_decode($this->translation->options) as $replacementKey) {

            $this->translation->translation = str_replace($replacementKey, !empty($this->options[$replacementKey]) ? $this->options[$replacementKey] : '', $this->translation->translation);
        }

        return $this;
    }

    private function insertNewData()
    {
        $query = '
             INSERT INTO translations
             (text) VALUES (:text)
        ';

        $data = $this->pdo->prepare($query);

        $data->execute([
            ':text' => $this->translationKey
        ]);
    }
}