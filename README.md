zf-doctrine-hydrator
====================

A collection of common hydrators for [`phpro/zf-doctrine-hydration-module`](https://github.com/phpro/zf-doctrine-hydration-module) written for use with [`zfcampus/zf-apigility-doctrine`](https://github.com/zfcampus/zf-apigility-doctrine).


Strategy\CollectionExtract
--------------------------

Extract a collection.  Often when this is used the entities in the collection have a many to one relationship with the entity the collection belongs to.  In this case it is recommended you use the EntityLink for the parent on the child.


Strategy\CollectionLink
-----------------------

This strategy will replace a collection with just a self link to the collection.  It uses [`zfcampus/zf-doctrine-querybuilder`](https://github.com/API-Skeletons/zf-doctrine-querybuilder) to create a query for just the collection data.


Strategy\EntityLink
-------------------

Will replace an entity with just a self link to the entity.  Use when a child is part of a collection referenced by the parent and the parent is a property of the child.


How to use these hydration strategies
=====================================

In your configuration for your Doctrine in Apigility API the `doctrine-hydrator` section add a strategy to an entity.  In this example an Artist is a member of a Band which, by example, is a many to one relationship (an artist can only have one band).

```php
    'doctrine-hydrator' => array(
        'DatabaseApi\\V1\\Rest\\Album\\SongHydrator' => array(
            'entity_class' => 'Database\\Entity\\Song',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'use_generated_hydrator' => true,
        ),
        'DatabaseApi\\V1\\Rest\\Album\\AlbumHydrator' => array(
            'entity_class' => 'Database\\Entity\\Album',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => array(
                'artist' => 'ZF\Doctrine\Hydrator\Strategy\EntityLink',
                'song' => 'ZF\Doctrine\Hydrator\Strategy\CollectionLink',
            ),
            'use_generated_hydrator' => true,
        ),
        'DatabaseApi\\V1\\Rest\\Artist\\ArtistHydrator' => array(
            'entity_class' => 'Database\\Entity\\Artist',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => array(
                'album' => 'ZF\Doctrine\Hydrator\Strategy\CollectionExtract',
            ),
            'use_generated_hydrator' => true,
        ),
```

When an Artist is queried all Albums for the Artist will be returned.  For each Album the Artist will be returned only as a self link.  The result of a call to `https://api/artist/1` will look like:

```json
{
    "id": 1,
    "name": "Soft Cell",
    "_embedded": {
        "album": [
            {
                "id": 1,
                "name": "Non-Stop Erotic Cabaret",
                "_embedded": {
                    "artist": {
                        "_links": {
                            "self": "https://api/artist/1"
                        }
                    },
                    "song": {
                        "_links": {
                            "self": "https://api/song?filter%5B0%5D%5Bfield%5D=album&filter%5B0%5D%5Btype%5D=eq&filter%5B0%5D%5Bvalue%5D=1"
                        }
                    }
                        {
                            "id": 1,
                            "name": "Frustration",
                            "_embedded": {
                                "album":
                                    "_links": {
                                        "self": "https://api/album/1"
                                    }
                                }
                            }
                        }
                        {
                            "id": 2,
                            "name": "Tainted Love",
                            "_embedded": {
                                "album":
                                    "_links": {
                                        "self": "https://api/album/1"
                                    }
                                }
                            }
                        }
                    ]
                },
                "_links": {
                    "self": "https://api/album/1"
                }
            }
        ],
    },
    "_links": {
        "self": "https://api/artist/1"
    }
}
```

