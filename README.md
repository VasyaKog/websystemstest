Yii 2 Basic Project Template
============================

# Manual from start

### Root dir
Project root dir -- is root from apache or OpenServer
### Composer 
Install or update composer 
```
composer install
```
or
```
composer update
```

### Configure db

Input in `config\db.php` valid data

```
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=websystemstest',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
``` 

### Creating folder from images

Run in root file command 
```
php yii default/create-folders
```