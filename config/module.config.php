<?php

return array(
    'JVCache' => array(
        'useCache' => false,
        'adapter' => 'filesystem',
        'ttl' => 7200, // 1 hora = 3600, 2 horas 7200,
        'cacheDir' => __DIR__ . '/../../../data/cache',
    ),
    'service_manager' => array(
        'factories' => array(
            'jvcache-cache' => 'JVCache\Factory\Cache',
        )
    )
);