<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Zend\Filter',
        'Zend\Hydrator',
        'Zend\InputFilter',
        'Zend\Paginator',
        'Zend\Router',
        'Zend\Validator',
        'ZF\\Apigility',
        'ZF\\Apigility\\Provider',
        'ZF\\ApiProblem',
        'ZF\\Configuration',
        'ZF\\OAuth2',
        'ZF\\MvcAuth',
        'ZF\\Hal',
        'ZF\\ContentNegotiation',
        'ZF\\ContentValidation',
        'ZF\\Rest',
        'ZF\\Rpc',
        'ZF\\Versioning',
        'DoctrineModule',
        'DoctrineORMModule',
        'Phpro\DoctrineHydrationModule',
        'ZF\\Apigility\\Doctrine\\Server',
        'ZF\\Doctrine\\Hydrator',
        'Db',
        'DbApi',
    ),

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => array(
            'Db' => __DIR__ . '/module/Db',
            'DbApi' => __DIR__ . '/module/DbApi',
        ),

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            __DIR__ . '/autoload/{,*.}{global,local}.php',
        ),

    ),
);
