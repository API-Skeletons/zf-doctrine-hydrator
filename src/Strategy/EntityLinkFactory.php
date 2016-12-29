<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class EntityLinkFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, $requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        $entityLink = new EntityLink();
        $entityLink->setMetadataMap($config['zf-hal']['metadata_map']);
        $entityLink->setDoctrineHydratorConfig($config['doctrine-hydrator']);
        $entityLink->setServiceLocator($container);

        return $entityLink;
    }
}
