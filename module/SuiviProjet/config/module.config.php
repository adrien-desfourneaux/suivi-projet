<?php
/**
 * Fichier de configuration pour le module SuiviProjet.
 *
 * PHP Version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/config/module.config.php
 */

/**
 * Utiliser différentes base de données pour les
 * environnements de test et de développement
 */
if (defined('SUIVIPROJET_ENV') && SUIVIPROJET_ENV == 'test') {
    $db_path = __DIR__ . '/../tests/_data/suivi-projet.sqlite';
} else {
    $db_path = __DIR__ . '/../data/suivi-projet.sqlite';
}

return array(
    'router' => array(
        'routes' => array(
            'suivi-projet' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '[/]',
                    'defaults' => array(
                        'controller' => 'dz-project',
                        'action'     => 'showall',
                        'type'       => 'active'
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'suivi-projet_model' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/SuiviProjet/Model'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'SuiviProjet\Model' => 'suivi-projet_model'
                )
            )
        ),
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'path' => __DIR__.'/../data/suivi-projet.sqlite',
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'dz-project_service' => 'SuiviProjet\Service\ProjectServiceFactory',
        )
    ),
//    'service_manager' => array(
//        'abstract_factories' => array(
//            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
//            'Zend\Log\LoggerAbstractServiceFactory',
//        ),
//        'aliases' => array(
//            'translator' => 'MvcTranslator',
//        ),
//    ),
//    'translator' => array(
//        'locale' => 'en_US',
//        'translation_file_patterns' => array(
//            array(
//                'type'     => 'gettext',
//                'base_dir' => __DIR__ . '/../language',
//                'pattern'  => '%s.mo',
//            ),
//        ),
//    ),
//    'controllers' => array(
//        'invokables' => array(
//            'SuiviProjet\Controller\Index' => 'SuiviProjet\Controller\IndexController'
//        ),
//    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
//    'console' => array(
//        'router' => array(
//            'routes' => array(
//            ),
//        ),
//    ),
    'doctrine' => array(
        'driver' => array(
            'suivi-projet_model' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/SuiviProjet/Model'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'SuiviProjet\Model' => 'suivi-projet_model'
                )
            )
        ),
        'connection' => array(
            // Connection for acceptance tests
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'path' => $db_path,
                )
            )
        )
    ),
);
