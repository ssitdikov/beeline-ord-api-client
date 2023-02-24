# PHP client for Beeline ORD API

[https://ord.beeline.ru/](https://ord.beeline.ru/)

## This is not an official package

**No support guaranteed.**

Installation:
```
composer require klkvsk/beeline-ord-api-client
```

Usage:
```php
<?php

$client = new \BeelineOrd\ApiClient(
    new \BeelineOrd\Authorization\Credentials('login', 'password'),
    $token, // if saved from previous session
);

/** @see src/Endpoint/ */
$client->contract()->....
$client->creative()->....
$client->invoice()->....
$client->platform()->....

// OR

$client->send(new \BeelineOrd\Request\SomethingRequest());

// save accessToken for next session:
$token = $client->getToken();
```

