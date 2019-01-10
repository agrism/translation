<?php

namespace Paylatergroup\Translation\Services;


use Paylatergroup\Translation\ITranslation;

class MysqlService extends Service implements ITranslation
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    protected function getData()
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

    protected function insertNewData()
    {
        $query = 'INSERT INTO translations (text) VALUES (:text)';

        $data = $this->pdo->prepare($query);

        $data->execute([
            ':text' => $this->translationKey
        ]);
    }
}