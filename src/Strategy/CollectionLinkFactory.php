<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CollectionLinkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

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
