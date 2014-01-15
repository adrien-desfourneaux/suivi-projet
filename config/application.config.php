<?php

/**
 * Configuration de l'application Suivi-projet
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @package    Suivi-projet
 * @category   Config
 * @license    http://opensource.org/licenses/MIT
 */

return array(
    'modules' => array(
        'ZendDeveloperTools',
        'OcraServiceManager',
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcUser',
        'DzProject',
        'Application'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
        ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,local}.php')
    )
);
