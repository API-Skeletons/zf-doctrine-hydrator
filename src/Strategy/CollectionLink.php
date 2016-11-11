<?php

namespace ZF\Doctrine\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Zend\Filter\FilterChain;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
use ZF\Hal\Link\LinkCollection;
use ZF\Hal\Entity as HalEntity;
use ZF\Hal\Link\Link;
use stdClass;

/**
 * A field-specific hydrator for collections.
 *
 * @returns Link
 */
class CollectionLink extends AbstractCollectionStrategy implements
    StrategyInterface
{
    protected $metadataMap;
    protected $filterKey;

    public function setMetadataMap(array $map)
    {
        $this->metadataMap = $map;

        return $this;
    }

    public function getMetadataMap()
    {
        return $this->metadataMap;
    }

    public function setFilterKey($key)
    {
        $this->filterKey = $key;

        return $this;
    }

    public function getFilterKey()
    {
        return $this->filterKey;
    }

    public function extract($value)
    {
        if (! method_exists($value, 'getTypeClass')) {
            return;
        }

        $config = $this->getMetadataMap()[$value->getTypeClass()->name];

        $filter = new FilterChain();
        $filter
            ->attachByName('WordCamelCaseToUnderscore')
            ->attachByName('StringToLower');

        // Better way to create mapping name?
        // FIXME: use zf-hal collection_name
        $link = new Link('self');
        $link->setRoute($config['route_name']);
        $link->setRouteParams(array('id' => null));

        $filterValue = array(
            'field' => $value->getMapping()['mappedBy'] ? : $value->getMapping()['inversedBy'],
            'type' =>isset($value->getMapping()['joinTable']) ? 'ismemberof' : 'eq',
            'value' => $value->getOwner()->getId(),
        );

        $link->setRouteOptions(array(
            'query' => array(
                $this->getFilterKey() => array(
                    $filterValue,
                ),
            ),
        ));

        $linkCollection = new LinkCollection();
        $linkCollection->add($link);

        $halEntity = new HalEntity(new stdClass());
        $halEntity->setLinks($linkCollection);

        return $halEntity;
    }

    public function hydrate($value)
    {
        // This strategy does note support hydration of collections.
    }
}
