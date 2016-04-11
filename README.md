zf-doctrine-hydrator
====================

A collection of common hydrators for `phpro/zf-doctrine-hydration-module` written for use with `zfcampus/zf-apigility-doctrine`.


Strategy\CollectionExtract
--------------------------

Extract a collection.  Often when this is used the entities in the collection have a many to one relationship with the entity the collection belongs to.  In this case it is recommended you use the EntityLink for the parent on the child.


Strategy\CollectionLink
-----------------------

This strategy will replace a collection with just a self link to the collection.


Strategy\EntityLink
-------------------

Will replace an entity with just a self link to the entity.  Use when a child is part of a collection referenced by the parent and the parent is a property of the child.
