<?php

/**
 * Fichier de configuration pour Zend\Db
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @package    Suivi-projet
 * @category   Config
 * @license    http://opensource.org/licenses/MIT
 */

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                return new Zend\Db\Adapter\Adapter(array(
                    'driver' => 'Pdo_Sqlite',
                    'database' => __DIR__ . '/../../data/suivi-projet.sqlite'
                ));
            },
        ),
    ),
);
