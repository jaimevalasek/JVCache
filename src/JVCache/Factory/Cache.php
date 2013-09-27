<?php

namespace JVCache\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\Cache\StorageFactory;

class Cache implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $cache = StorageFactory::factory(array(
            'adapter' => array(
                'name' => $config['JVCache']['adapter'],
                'options' => array(
                    'ttl' => $config['JVCache']['ttl'], // Tempo em segundos
                    'cacheDir' => $config['JVCache']['cacheDir']
                ),
            ),
            'plugins' => array(
                'exception_handler' => array('throw_exceptions' => false),
                'Serializer'
            )
        ));
        
        $return = new \stdClass();
        $return->cache = $cache;
        $return->status = $config['JVCache']['useCache'];
        
        return $return;
    }
}