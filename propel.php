<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'catalog-site' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=catalog-site',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'catalog-site',
            'connections' => ['catalog-site']
        ],
        'generator' => [
            'defaultConnection' => 'catalog-site',
            'connections' => ['catalog-site']
        ]
    ]
];