# register

```
use \Paylatergroup\Translation\Translation as Translation;

$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=xx_xxxx', 'root', '');

Translation::initService(Translation::TYPE_CONTENT, new \Paylatergroup\Translation\Services\MysqlService($pdo));
```

# set/change locale
```
Translation::setLanguageCode(Translation::TYPE_CONTENT,'ru');
```

# use
```
_c('Hello :name, how are you!', [':name'=>'Hugo']);
```
