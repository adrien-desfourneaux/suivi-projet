<?php

/**
 * Lance l'application de développement du module SuiviProjet.
 * Seuls le module SuiviProjet et ses dépendances seront chargées.
 * Cela permet le développement du module SuiviProjet seul, séparé
 * du reste de l'application.
 *
 * Utilisation :
 * http://mydomain/suiviprojet.php[/:controller[/:action]]
 *
 * PHP Version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/public/suiviproject.php
 */

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'module/SuiviProjet/config/application.config.php')->run();
