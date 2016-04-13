<?php

namespace Db;

return array(
    'doctrine' => array(
        'driver' => array(
           'db_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => array(__DIR__ . '/orm'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => 'db_driver',
                ),
            ),
        ),
    ),
);
