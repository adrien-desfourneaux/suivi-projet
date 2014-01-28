<?php

/**
 * Fichier de configuration de l'application suivi-projet.
 *
 * Afin d'utiliser un minimum de modules en production, 
 * on ne charge les modules de développement que si la
 * variable APP_ENV vaut "development".
 *
 * PHP Version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/config/application.config.php
 */

$env = getenv('APP_ENV') ?: 'production';

// Use the $env value to determine which modules to load
$modules = array(
    // Dependency modules
    'DoctrineModule',
    'DoctrineORMModule',
    'ZfcBase',
    'ZfcUser',

    // Business modules
    'DzProject',
    'DzTask',
    'SuiviProjet'
);

if ($env == 'development') {
    // Development modules
    array_push(
        $modules,
        'ZendDeveloperTools',
        'OcraServiceManager'
    );
}

return array(
    'modules' => $modules,
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
        ),
        'config_glob_paths' => array(
            sprintf('config/autoload/{,*.}{global,%s,local}.php', $env)
        ),
    )
);
