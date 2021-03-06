<?php

namespace Db;

return [
    'doctrine' => [
        'driver' => [
            'db_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => [__DIR__ . '/orm'],
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => 'db_driver',
                ],
            ],
        ],
    ],
];
