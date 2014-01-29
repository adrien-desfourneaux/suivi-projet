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
    $db_path = __DIR__ . '/../tests/_data/suiviprojet.sqlite';
} else {
    $db_path = __DIR__ . '/../data/suiviprojet.sqlite';
}

return array(
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
    'router' => array(
        'routes' => array(
            'suiviprojet' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '[/]',
                    'defaults' => array(
                        'controller' => 'dzproject',
                        'action'     => 'showall',
                        'type'       => 'active'
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'suiviprojet_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/SuiviProjet/Entity'
            ),
            'orm_default' => array(
                'drivers' => array(
                    'SuiviProjet\Entity' => 'suiviprojet_entity'
                )
            )
        ),
        'connection' => array(
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
    'dzproject' => array(
        'project_entity_class' => 'SuiviProjet\Entity\Project',
    ),
);
