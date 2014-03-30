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

use DzViewModule\ModuleManager\Feature\ViewModelProviderInterface;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

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
    BootstrapListenerInterface,
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ControllerProviderInterface,
    ViewModelProviderInterface,
    HydratorProviderInterface,
    ServiceProviderInterface
{
    /**
     * Ecoute l'évenement Bootstrap
     *
     * @param MvcEvent $event Evénement MVC
     *
     * @return array
     */
    public function onBootstrap(EventInterface $event)
    {
        $application    = $event->getTarget();
        $eventManager   = $application->getEventManager();
        $serviceManager = $application->getServiceManager();

        // Attache l'écouteur pour les événements du module DzProjectModule
        $eventManager->attach(new Listener\DzProjectListener($serviceManager));

        // Attache l'écouteur pour les événements du module DzTaskModule
        $listener = new Listener\DzTaskListener();
        $listener->setServiceLocator($serviceManager);
        $eventManager->attach($listener);
    }

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
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
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
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'SuiviProjet\TaskController' => 'SuiviProjet\Controller\Factory\TaskControllerFactory',
            ),
            'aliases' => array(
                'DzTaskModule\TaskController' => 'SuiviProjet\TaskController',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewModelConfig()
    {
        return array(
            'invokables' => array(
                'SuiviProjet\TaskListViewModel' => 'SuiviProjet\View\Model\TaskListViewModel',
            ),
            'aliases' => array(
                'DzTaskModule\ListViewModel' => 'SuiviProjet\TaskListViewModel',
            ),
        );
    }

    /**
     * Doit retourner un objet de type \Zend\ServiceManager\Config
     * ou un tableau pour créer un tel objet.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getHydratorConfig()
    {
        return array(
            'factories' => array(
                'SuiviProjet\ProjectHydrator'  => 'SuiviProjet\Hydrator\Factory\ProjectHydratorFactory',
            ),
            'aliases' => array(
                'DzProjectModule\ProjectHydrator' => 'SuiviProjet\ProjectHydrator',
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
            'invokables' => array(
                'SuiviProjet\UserAssociationStrategy'  => 'SuiviProjet\Hydrator\Strategy\UserAssociationStrategy',
                'SuiviProjet\TasksAssociationStrategy' => 'SuiviProjet\Hydrator\Strategy\TasksAssociationStrategy',
            ),
            'factories' => array(
                'SuiviProjet\ProjectMapper' => 'SuiviProjet\Factory\ProjectMapperFactory',
                //'SuiviProjet\TaskMapper'    => 'SuiviProjet\Factory\TaskMapperFactory',
            ),
            'aliases' => array(
                //'DzProjectModule\ProjectMapper' => 'SuiviProjet\ProjectMapper',
                //'DzTaskModule\TaskMapper'       => 'SuiviProjet\TaskMapper',
            ),

                // Remplace le Mapper DzTaskModule\Mapper\Task par SuiviProjet\Mapper\Task
                /*'dztask_task_mapper' => function ($serviceManager) {
                    $options = $serviceManager->get('dztask_module_options');
                    $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getTaskEntityClass();

                    return new Mapper\Task($entityManager, $entityClass);
                },*/
        );
    }
}
