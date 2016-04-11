<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityLinkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (isset($config['zf-doctrine-querybuilder-options']['filter_key'])) {
            $filterKey = $config['zf-doctrine-querybuilder-options']['filter_key'];
        } else {
            $filterKey = 'filter';
        }

        $entityLink = new EntityLink();
        $entityLink->setMetadataMap($config['zf-hal']['metadata_map']);

        return $entityLink;
    }
}
