<?php

/**
 * Fichier de configuration de OcraServiceManager.
 *
 * Ce fichier, de suffixe ".development.php" n'est chargé que si la valeur de
 * APP_ENV vaut "development". Cette variable peut être changée dans le
 * fichier /public/.htaccess à la ligne SetEnv "App_Env" "development".
 *
 * PHP Version 5.3.3
 *
 * @category Config
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/config/autoload/ocra-service-manager.development.php
 */ 
return array(
    'ocra_service_manager' => array(
        // Turn this on to disable dependencies view in Zend Developer Tools
        'logged_service_manager' => true,
    ),
);
