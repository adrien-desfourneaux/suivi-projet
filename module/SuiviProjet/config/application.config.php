<?php
/**
 * Fichier de configuration de l'application pour les tests.
 *
 * Ce fichier contient uniquement les modules vraiment nécessaires
 * au fonctionnement du module SuiviProjet.
 *
 * Ce fichier peut être lancé soit par /public/suivi-projet.php
 * ou /public/test/suivi-projet.php
 *
 * PHP version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/application.config.php
 */
return array(
    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'DzProject',
        'SuiviProjet'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            __DIR__ . '/../../../module',
            __DIR__ . '/../../../vendor'
        )
    ),
);
