# PhpunitG Package

Client package for https://github.com/oscarricardosan/phpunitg-laravel-dashboard .


## Install

1) In your terminal:

```bash
$ composer require --dev oscarricardosan/phpunitg_laravel
```

2) When you register the application with https://github.com/oscarricardosan/phpunitg-laravel-dashboard it generates a token which you must put in the .env of the application.
```text
PHPUNITG_TOKEN=Generated_token
```
    
3) Add the service provider to your config/app.php file:
```php
 \Oscarricardosan\PhpunitgLaravel\OscarricardosanPhpunitgServiceProvider::class
```

4) Select the tests that you want to be scanned and put @phpunitG in phpDoc comments, with this you indicate to the package that this class must be scanned.

Optional, after @phpunitG you can put text that will serve as a tag name, if you do not put it it will remain as "No Tag".
```php
<?php namespace App;

/**
* @phpunitG Tag name
*/
class ExampleTest extends TestCase{...My code...}
```

5) In the methods that will be scanned put @test
```php
/**
* @test
*/
public function is_index_working(){...My code...}
``` 