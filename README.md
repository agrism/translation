# Content

```
// register

use \Paylatergroup\Translation\Translation as Translation;

$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=xx_xxxx', 'root', '');

Translation::initService(Translation::TYPE_CONTENT, new \Paylatergroup\Translation\Services\MysqlService($pdo));

// set/change locale

Translation::setLanguageCode(Translation::TYPE_CONTENT,'ru');

// use 

_c('Hello :name, how are you!', [':name'=>'Hugo']);
```

# Interface
```
// register

use \Paylatergroup\Translation\Translation as Translation;

$sdk = new Aws\Sdk([
    'endpoint'   => 'http://localhost:8000',
    'region'   => 'us-west-2',
    'version'  => 'latest'
]);

$dynamodb = $sdk->createDynamoDb();

Translation::initService(Translation::TYPE_INTERFACE, new \Paylatergroup\Translation\Services\DynamoService($dynamodb));

// set/change locale

Translation::setLanguageCode(Translation::TYPE_INTERFACE,'ru');

// use

_i('Good morning :name', [':name'=>'Hugo']);
```
