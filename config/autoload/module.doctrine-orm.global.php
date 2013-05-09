<?php

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'prs',
                    'password' => 'gYG_78HvVr6UU_iu@',
                    'dbname'   => 'prs',
                )
            )
        ),
        'driver' => array(
            'orm_default' => array(
                'class' => 'Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain',
                'drivers' => array(
                    'SkyParking' => 'parking',
                ),
            ),
            'parking' => array (
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array('module/SkyParking/src/SkyParking/Entity'),
            ),
          /*  __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),*/
          /*  'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )*/
        )
    )
);
