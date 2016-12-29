<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class CollectionLinkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, $requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        if (isset($config['zf-doctrine-querybuilder-options']['filter_key'])) {
            $filterKey = $config['zf-doctrine-querybuilder-options']['filter_key'];
        } else {
            $filterKey = 'filter';
        }

        $collectionLink = new CollectionLink();
        $collectionLink->setMetadataMap($config['zf-hal']['metadata_map']);
        $collectionLink->setFilterKey($filterKey);

        return $collectionLink;
    }
}
