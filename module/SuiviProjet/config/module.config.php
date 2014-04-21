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
    'assets' => array(
        'paths' => array(
            'suiviprojet' => __DIR__ . '/../public',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'index'  => 'SuiviProjet\Controller\IndexController',
            'dzuser' => 'SuiviProjet\Controller\UserController',
        ),
    ),
    'router' => array(
        'routes' => array(

            // Accueil
            // Affiche la liste des projets actifs
            'suiviprojet' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),

                    'may_terminate' => true,
                    'child_routes' => array(

                        // Information du module
                        'module' => array(
                            'type' => 'Segment',
                            'options' => array(
                                'route' => 'module[/]',
                                'defaults' => array(
                                    'action' => 'module',
                                ),
                            ),
                        ),
                    ),
                ),
            ),

            // Projet
            'dzproject' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/project[/]',
                ),

                'child_routes' => array(

                    // Listing des projets suivis
                    // Amélioration de la route originale
                    'list' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'list[/:type][/]',
                            'constraints' => array(
                                'type' => '(all)|(active)|(followed)',
                            ),
                            'defaults' => array(
                                'action' => 'list',
                                'type' => 'followed',
                            ),
                        ),
                    ),
                ),
            ),

            // Tâche
            'dztask' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/task[/]',
                ),

                'child_routes' => array(

                    // Listing des taches d'un projet
                    // Amélioration de la route originale
                    'list' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'list/:id[/]',
                            'constraints' => array(
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                'controller' => 'dztask',
                                'action' => 'list',
                            ),
                        ),
                    ),
                ),
            ),

            // Utilisateur
            'dzuser' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/]',
                ),

                'child_routes' => array(

                    // Compte utilisateur
                    'account' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'account[/]',
                        ),
                        'defaults' => array(
                            'controller' => 'dzuser',
                            'action' => 'account',
                        ),
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
    'dztask' => array(
        'task_entity_class' => 'SuiviProjet\Entity\Task',
    ),
    'dzuser' => array(
        /**
         * Active le nom d'affichage
         *
         * Active le champ nom d'affichage dans le formulaire d'enregistrement.
         * Le nom d'affichage est alors enregistré dans la base de données.
         * La valeur par défaut est false
         *
         * Valeurs acceptées : booléen true ou false
         */
        'enable_display_name' => true,

        /**
         * Active l'enregistrement
         *
         * Autorise les utilisateurs à s'enregistrer sur le site.
         *
         * Valeurs acceptées: (booléen) true ou false
         */
        'enable_registration' => false,
    ),
);
