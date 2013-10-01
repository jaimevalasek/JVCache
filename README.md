JVCache - JV Cache
================
Create By: Jaime Marcelo Valasek

Use this module to generate and store caches queries or objects.

Futures video lessons can be developed and published on the website or Youtube channel http://www.zf2.com.br/tutoriais http://www.youtube.com/zf2tutoriais

Installation
-----
Download this module into your vendor folder.

After done the above steps, open the file `config/application.config.php`. And add the module with the name JVCache.

### With composer

```php
"require": {
    "jaimevalasek/jv-cache": "dev-master"
}
```

Now tell composer to download JVCache by running the command:
```php
$ php composer.phar update
```

### Enabling it in your `application.config.php`.
```php
<?php
return array(
    'modules' => array(
        // ...
        'JVCache',
    ),
    // ...
);
```

### Add the following code in the module file module.config.php JVConfig or in your application module
```php
'JVCache' => array(
    'useCache' => false,
    'adapter' => 'filesystem',
    'ttl' => 7200, // 1 hora = 3600, 2 horas 7200,
    'cacheDir' => __DIR__ . '/../../../data/cache',
),
```

Using the JVCache
-----

 - Options enabling caching and lifetime are configured within the module file module.config.php

```php

/* used example using the module JVBase */

/**
 * if the cache is enabled this method will check if the result is 
 * already stored if otherwise we will select products and store in cache.
 */
public function listProducts($table, $resultType, $order, $limit)
{
	// Instantiating the service
	$serviceCache = $this->getServiceLocator()->get('jvcache-cache');
	
	// set a variable $cacheSuccess how false
	$cacheSuccess = false;
	
	// Caching Products requests not to do so in the Bank
	if ($serviceCache->status) {
	    $resultCache = $serviceCache->cache->getItem('findAllProdutosIndex', $cacheSuccess);
	    
	    if ($cacheSuccess) {
	        $result = unserialize($resultCache);
	    }
	}
	
	if (!$cacheSuccess) {
	    $result = $this->findAll($table, $resultType, $order, $limit);
	
	    // if the status is true then generates the cache file
	    if ($factoryCache->status) {
	        $resultCache = serialize($result);
	        $serviceCache->cache->addItem('findAllProdutosIndex', $resultCache);
	    }
	}
	
	return $result;
		
}
```