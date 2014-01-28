<?php

/**
 * Fichier de configuration de BjyProfiler.
 *
 * Ce fichier, de suffixe ".development.php" n'est chargé que si la valeur de
 * APP_ENV vaut "development". Cette variable peut être changée dans le
 * fichier /public/.htaccess à la ligne SetEnv "App_Env" "development".
 *
 * Le module BjyProfiler est configuré pour utiliser la base de données de
 * développement du module SuiviProjet 
 * /module/SuiviProjet/data/suivi-projet.sqlite
 *
 * La base de données de production, quand à elle est stockée dans
 * /data/suivi-projet.sqlite
 *
 * PHP Version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/config/autoload/bjyprofiler.development.php
 */ 

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(
                    array(
                        'driver' => 'Pdo_Sqlite',
                        'database' => __DIR__ . '/../../module/SuiviProjet/data/suivi-projet.sqlite'
                    )
                );

                if (php_sapi_name() == 'cli') {
                    $logger = new Zend\Log\Logger();
                    // write queries profiling info to stdout in CLI mode
                    $writer = new Zend\Log\Writer\Stream('php://output');
                    $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                } else {
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                }
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                } else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            },
        ),
    ),
);

