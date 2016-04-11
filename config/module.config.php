<?php

return array(
    'service_manager' => array(
        'invokables' => array(
            'ZF\Doctrine\Hydrator\Strategy\CollectionExtract' =>
                'ZF\Doctrine\Hydrator\Strategy\CollectionExtract',
        ),
        'factories' => array(
            'ZF\Doctrine\Hydrator\Strategy\CollectionLink' =>
                'ZF\Doctrine\Hydrator\Strategy\CollectionLinkFactory',
            'ZF\Doctrine\Hydrator\Strategy\EntityLink' =>
                'ZF\Doctrine\Hydrator\Strategy\EntityLinkFactory',
        ),
    ),
);