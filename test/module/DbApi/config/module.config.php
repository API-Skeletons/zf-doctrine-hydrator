<?php

return [
    'router' => [
        'routes' => [
            'db-api.rest.doctrine.album' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/album[/:album_id]',
                    'defaults' => [
                        'controller' => 'DbApi\\V1\\Rest\\Album\\Controller',
                    ],
                ],
            ],
            'db-api.rest.doctrine.artist' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/artist[/:artist_id]',
                    'defaults' => [
                        'controller' => 'DbApi\\V1\\Rest\\Artist\\Controller',
                    ],
                ],
            ],
            'db-api.rest.doctrine.song' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/song[/:song_id]',
                    'defaults' => [
                        'controller' => 'DbApi\\V1\\Rest\\Song\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'db-api.rest.doctrine.album',
            1 => 'db-api.rest.doctrine.artist',
            2 => 'db-api.rest.doctrine.song',
        ],
    ],
    'zf-rest' => [
        'DbApi\\V1\\Rest\\Album\\Controller' => [
            'listener' => 'DbApi\\V1\\Rest\\Album\\AlbumResource',
            'route_name' => 'db-api.rest.doctrine.album',
            'route_identifier_name' => 'album_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'album',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Db\\Entity\\Album',
            'collection_class' => 'DbApi\\V1\\Rest\\Album\\AlbumCollection',
            'service_name' => 'Album',
        ],
        'DbApi\\V1\\Rest\\Artist\\Controller' => [
            'listener' => 'DbApi\\V1\\Rest\\Artist\\ArtistResource',
            'route_name' => 'db-api.rest.doctrine.artist',
            'route_identifier_name' => 'artist_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'artist',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Db\\Entity\\Artist',
            'collection_class' => 'DbApi\\V1\\Rest\\Artist\\ArtistCollection',
            'service_name' => 'Artist',
        ],
        'DbApi\\V1\\Rest\\Song\\Controller' => [
            'listener' => 'DbApi\\V1\\Rest\\Song\\SongResource',
            'route_name' => 'db-api.rest.doctrine.song',
            'route_identifier_name' => 'song_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'song',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Db\\Entity\\Song',
            'collection_class' => 'DbApi\\V1\\Rest\\Song\\SongCollection',
            'service_name' => 'Song',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'DbApi\\V1\\Rest\\Album\\Controller' => 'HalJson',
            'DbApi\\V1\\Rest\\Artist\\Controller' => 'HalJson',
            'DbApi\\V1\\Rest\\Song\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'DbApi\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'DbApi\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'DbApi\\V1\\Rest\\Song\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'DbApi\\V1\\Rest\\Album\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/json',
            ],
            'DbApi\\V1\\Rest\\Artist\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/json',
            ],
            'DbApi\\V1\\Rest\\Song\\Controller' => [
                0 => 'application/vnd.db-api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Db\\Entity\\Album' => [
                'route_identifier_name' => 'album_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.album',
                'hydrator' => 'DbApi\\V1\\Rest\\Album\\AlbumHydrator',
            ],
            'DbApi\\V1\\Rest\\Album\\AlbumCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.album',
                'is_collection' => true,
            ],
            'Db\\Entity\\Artist' => [
                'route_identifier_name' => 'artist_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.artist',
                'hydrator' => 'DbApi\\V1\\Rest\\Artist\\ArtistHydrator',
            ],
            'DbApi\\V1\\Rest\\Artist\\ArtistCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.artist',
                'is_collection' => true,
            ],
            'Db\\Entity\\Song' => [
                'route_identifier_name' => 'song_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.song',
                'hydrator' => 'DbApi\\V1\\Rest\\Song\\SongHydrator',
            ],
            'DbApi\\V1\\Rest\\Song\\SongCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'db-api.rest.doctrine.song',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-apigility' => [
        'doctrine-connected' => [
            'DbApi\\V1\\Rest\\Album\\AlbumResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'DbApi\\V1\\Rest\\Album\\AlbumHydrator',
            ],
            'DbApi\\V1\\Rest\\Artist\\ArtistResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'DbApi\\V1\\Rest\\Artist\\ArtistHydrator',
            ],
            'DbApi\\V1\\Rest\\Song\\SongResource' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'DbApi\\V1\\Rest\\Song\\SongHydrator',
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'DbApi\\V1\\Rest\\Album\\AlbumHydrator' => [
            'entity_class' => 'Db\\Entity\\Album',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'artist' => 'ZF\Doctrine\Hydrator\Strategy\EntityLink',
                'song' => 'ZF\Doctrine\Hydrator\Strategy\CollectionLink',
            ],
            'use_generated_hydrator' => true,
        ],
        'DbApi\\V1\\Rest\\Artist\\ArtistHydrator' => [
            'entity_class' => 'Db\\Entity\\Artist',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [
                'album' => 'ZF\Doctrine\Hydrator\Strategy\CollectionExtract',
            ],
            'use_generated_hydrator' => true,
        ],
        'DbApi\\V1\\Rest\\Song\\SongHydrator' => [
            'entity_class' => 'Db\\Entity\\Song',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
        'DbApi\\V1\\Rest\\Album\\Controller' => [
            'input_filter' => 'DbApi\\V1\\Rest\\Album\\Validator',
        ],
        'DbApi\\V1\\Rest\\Artist\\Controller' => [
            'input_filter' => 'DbApi\\V1\\Rest\\Artist\\Validator',
        ],
        'DbApi\\V1\\Rest\\Song\\Controller' => [
            'input_filter' => 'DbApi\\V1\\Rest\\Song\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'DbApi\\V1\\Rest\\Album\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => 'Zend\\Filter\\StringTrim',
                    ],
                    1 => [
                        'name' => 'Zend\\Filter\\StripTags',
                    ],
                ],
                'validators' => [],
            ],
        ],
        'DbApi\\V1\\Rest\\Artist\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => 'Zend\\Filter\\StringTrim',
                    ],
                    1 => [
                        'name' => 'Zend\\Filter\\StripTags',
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 255,
                        ],
                    ],
                ],
            ],
        ],
        'DbApi\\V1\\Rest\\Song\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => 'Zend\\Filter\\StringTrim',
                    ],
                    1 => [
                        'name' => 'Zend\\Filter\\StripTags',
                    ],
                ],
                'validators' => [],
            ],
        ],
    ],
];
