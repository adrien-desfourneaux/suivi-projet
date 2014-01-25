<?php
/**
 * Module class file for the Suivi-Projet Application module.
 *
 * PHP Version 5.3.3
 *
 * @category Source
 * @package  Suivi-Projet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/Application/Module.php
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Module class for the Suivi-Projet Application module.
 *
 * @category Source
 * @package  Suivi-Projet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/Application/Module.php
 */
class Module
{
    /**
     * Obtient le fichier de
     * configuration du module.
     * 
     * @return string
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * obtient la configuration de l'autoloader
     * pour les classes du module dzproject.
     *
     * @return array() configuration de l'autoloader.
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
