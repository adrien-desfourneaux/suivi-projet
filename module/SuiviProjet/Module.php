<?php
/**
 * Fichier de module pour de SuiviProjet
 *
 * PHP Version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/Module.php
 */

namespace SuiviProjet;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Classe de module de SuiviProjet.
 *
 * @category Source
 * @package  SuiviProjet
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/Module.php
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ViewHelperProviderInterface,
    ServiceProviderInterface
{
    /**
     * Retourne un tableau à parser par Zend\Loader\AutoloaderFactory.
     *
     * @return array
     *
     * @see AutoloaderProviderInterface
     */
    public function getAutoloaderConfig()
    {
        return array(
            /*'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),*/
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Retourne la configuration à fusionner avec
     * la configuration de l'application
     *
     * @return array|\Traversable
     *
     * @see ConfigProviderInterface
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'routeName' => function ($sm) {
                    $match = $sm->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
                    $viewHelper = new View\Helper\RouteName($match);
                    return $viewHelper;
                },
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     *
     * @see ServiceProviderInterface
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(

                // Remplace le Mapper DzProject\Mapper\Project par SuiviProjet\Mapper\Project
                'dzproject_project_mapper' => function ($sm) {
                    $options = $sm->get('dzproject_module_options');
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getProjectEntityClass();
                    $authService = $sm->get('zfcuser_auth_service');
                    return new Mapper\Project($entityManager, $entityClass, $authService);
                },

                // Remplace le Mapper DzTask\Mapper\Task par SuiviProjet\Mapper\Task
                'dztask_task_mapper' => function ($sm) {
                    $options = $sm->get('dztask_module_options');
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getTaskEntityClass();
                    return new Mapper\Task($entityManager, $entityClass);
                },
            ),
        );
    }
}
