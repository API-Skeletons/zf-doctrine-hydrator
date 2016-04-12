<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntityLinkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $entityLink = new EntityLink();
        $entityLink->setMetadataMap($config['zf-hal']['metadata_map']);
        $entityLink->setDoctrineHydratorConfig($config['doctrine-hydrator']);
        $entityLink->setServiceLocator($serviceLocator);

        return $entityLink;
    }
}
