<?php

namespace Paylatergroup\Translation\Services;


use Aws\DynamoDb\Marshaler;
use Paylatergroup\Translation\ITranslation;

class DynamoService extends Service implements ITranslation
{

    private $dynamoDb;

    private $marshaler;

    public function __construct($dynamoDb)
    {
        $this->dynamoDb = $dynamoDb;
        $this->marshaler = new Marshaler();
    }

    protected function getData()
    {
        $key = $this->marshaler->marshalJson('
            {
                "translationKey": "' . $this->translationKey . '"
            }
        ');

        $params = [
            'TableName' => 'translations',
            'Key' => $key
        ];

        $result = $this->dynamoDb->getItem($params);

        $obj = new \stdClass();

        $obj->translation = isset($result['Item'][$this->languageCode]['S']) ? $result['Item'][$this->languageCode]['S'] : null;
        $obj->text = $this->translationKey;
        $obj->options = isset($result['Item']['options']['S']) ? $result['Item']['options']['S'] : null;

        $this->translation = $obj;

        return $this;
    }

    protected function insertNewData()
    {
        $item = $this->marshaler->marshalJson('
            {
                "translationKey": "' . $this->translationKey . '"
            }
        ');

        $params = [
            'TableName' => 'translations',
            'Item' => $item
        ];

        $this->dynamoDb->putItem($params);
    }
}