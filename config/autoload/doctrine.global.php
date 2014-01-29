<?php

/**
 * Fichier de configuration global de Doctrine.
 *
 * PHP Version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/config/autoload/doctrine.global.php
 */ 

return array(
    'doctrine' => array(
        'connection' => array(
            // Connexion pour la production
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'path' => __DIR__ . '/../../data/suivi-projet.sqlite',
                )
            )
        )
    ),
);
