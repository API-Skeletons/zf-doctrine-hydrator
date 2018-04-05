<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Util\ClassUtils;
use ZF\Hal\Link\LinkCollection;
use ZF\Hal\Entity as HalEntity;
use ZF\Hal\Link\Link;
use stdClass;

/**
 * An entity-specific hydrator
 *
 * @returns Link
 */
class EntityLink implements
    StrategyInterface
{
    protected $serviceLocator;
    protected $metadataMap;
    protected $doctrineHydratorConfig;

    /**
      * The service locator must be injected here so an object manager
      * can be found for a given entity.  The object manager is used to
      * extract the entity to assign identifier field values to the route.
      * We cannot use reflection to get the values because the $value may
      * be a proxy object.
      */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setMetadataMap(array $metadataMap)
    {
        $this->metadataMap = $metadataMap;

        return $this;
    }

    public function getMetadataMap()
    {
        return $this->metadataMap;
    }

    public function setDoctrineHydratorConfig($config)
    {
        $this->doctrineHydratorConfig = $config;

        return $this;
    }

    public function getDoctrineHydratorConfig()
    {
        return $this->doctrineHydratorConfig;
    }

    /**
     * Look up the object manager for the given entity and create a basic hydrator
     */
    public function getHydratorForEntity($value)
    {
        $entityMetadata = $this->getMetadataMap()[ClassUtils::getRealClass(get_class($value))];
        $objectManagerClass = $this->getDoctrineHydratorConfig()[$entityMetadata['hydrator']]['object_manager'];

        return new DoctrineHydrator($this->getServiceLocator()->get($objectManagerClass), true);
    }

    /**
     * Return a HAL entity with just a self link
     */
    public function extract($value)
    {
        if (is_null($value)) {
            return $value;
        }

        $entityValues = $this->getHydratorForEntity($value)->extract($value);
        $entityMetadata = $this->getMetadataMap()[ClassUtils::getRealClass(get_class($value))];

        $link = new Link('self');
        $link->setRoute($entityMetadata['route_name']);
        $link->setRouteParams([
            $entityMetadata['route_identifier_name'] => $entityValues[$entityMetadata['entity_identifier_name']]
        ]);

        $linkCollection = new LinkCollection();
        $linkCollection->add($link);

        $halEntity = new HalEntity(new stdClass());
        $halEntity->setLinks($linkCollection);

        return $halEntity;
    }

    public function hydrate($value)
    {
        return $value;
    }
}
