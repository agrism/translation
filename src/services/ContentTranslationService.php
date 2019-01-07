<?php

namespace Paylatergroup\Translation\Services;


use Paylatergroup\Translation\ITranslation;

class ContentTranslationService implements ITranslation
{

    private $connection;

    private $languageCode;

    private $translationKey;

    private $options = [];

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function translate()
    {

        $data = $this->getData();

        $translation = $this->translationKey;

        if (empty($data->translation)) {
            if (empty($data->text)) {
                $this->insertNewData();
            } else {
                $translation = $data->text;
            }
        }

        echo $translation;
    }

    public function setLanguageCode($code)
    {
        $this->languageCode = $code;
        return $this;
    }

    public function setTranslationKey($translationKey)
    {
        $this->translationKey = $translationKey;
        return $this;
    }

    public function setOptions($options){
        $this->options = $options;
    }

    private function getData()
    {

        $query = '
            SELECT * FROM tf_admin.translations t
            LEFT JOIN tf_admin.translations_data td 
              ON  t.id = td.translation_id
              AND td.language_code = :language_code
            WHERE t.text = :key
        ';

        $data = $this->connection->prepare($query);

        $data->execute([
            ':language_code' => $this->languageCode,
            ':key' => $this->translationKey,
        ]);

        return $data->fetch();
    }

    private function insertNewData()
    {
        $query = '
             INSERT INTO tf_admin.translations
             (text) VALUES (:text)
        ';

        $data = $this->connection->prepare($query);

        $data->execute([
            ':text' => $this->translationKey
        ]);
    }
}