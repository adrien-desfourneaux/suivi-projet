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

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;

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
    ViewHelperProviderInterface,
    ServiceProviderInterface
{
    /**
     * Ecoute l'évenement Bootstrap
     *
     * @param EventInterface $event Evenement
     *
     * @return array
     */
    public function onBootstrap(EventInterface $event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();
        $events = $event->getApplication()->getEventManager()->getSharedManager();

        // Extraire les relations Project->Tasks et Project->User
        // en tableaux array
        $serviceManager->get('dzproject_project_hydrator')
            ->addStrategy('tasks', new \SuiviProjet\Hydrator\Strategy\TasksAssociation)
            ->addStrategy('user', new \SuiviProjet\Hydrator\Strategy\UserAssociation);

        // Modification des champs du listing projets (dzproject/list)
        $events->attach(
            'DzProject\Controller\ProjectController', 'initListFields', function ($e) {
                $projectController = $e->getTarget();
                $serviceManager = $projectController->getServiceLocator();
                $listFields = $projectController->getListFields();
                $projects = $e->getParam('projects');

                // Ajouter le champ "Chef de projet"
                $projectManagerField = array('heading' => 'Chef de projet');
                foreach ($projects as $p) {
                    $projectManagerField['values'][$p['project_id']] = $p['user']['display_name'];
                }

                // Le mettre en 2ème place (l'index commence à 0)
                array_splice($listFields, 1, 0, array($projectManagerField));

                // Mettre les liens vers les tâches de chaque projet
                // sur chaque element du listing
                for ($i=0; $i<count($listFields); $i++) {
                    $listFields[$i]['href'] = array();
                    foreach ($projects as $p) {
                        $listFields[$i]['href'][$p['project_id']] = $projectController->url()->fromRoute('dztask/list', array('id' => $p['project_id']));
                    }
                }

                // Ajouter les classes bootstrap pour marquer
                // les projets en retard et terminés
                // sur la page de compte utilisateur
                $routeMatch = $serviceManager->get('Application')->getMvcEvent()->getRouteMatch();
                if ($routeMatch->getMatchedRouteName() == 'dzuser/account') {
                    for($i=0; $i<count($listFields); $i++) {
                        $listFields[$i]['class'] = array();
                        foreach ($projects as $p) {
                            
                            // Projet en retard marqués -> classe "danger"
                            // Projet terminés en grisé -> classe "success"
                            if ($p['state'] == 'late') {
                                $listFields[$i]['class'][$p['project_id']] = "danger";
                            } elseif ($p['state'] == 'done') {
                                $listFields[$i]['class'][$p['project_id']] = "active";
                            }
                        }
                    }
                }

                // Renvoyer les champs modifiés à la target
                $projectController->setListFields($listFields);
            }
        );
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
                __DIR__ . '/autoload_classmap.php',
            ),
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
                'routeName' => function ($serviceManager) {
                    $match = $serviceManager->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
                    $viewHelper = new View\Helper\RouteName($match);
                    return $viewHelper;
                },
                'routeParams' => function ($serviceManager) {
                    $match = $serviceManager->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
                    $viewHelper = new View\Helper\RouteParams($match);
                    return $viewHelper;
                },
                'currentUrl' => function ($serviceManager) {
                    $request = $serviceManager->getServiceLocator()->get('request');
                    $viewHelper = new View\Helper\CurrentUrl($request);
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
                'dzproject_project_mapper' => function ($serviceManager) {
                    $options = $serviceManager->get('dzproject_module_options');
                    $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getProjectEntityClass();
                    $authService = $serviceManager->get('zfcuser_auth_service');
                    return new Mapper\Project($entityManager, $entityClass, $authService);
                },

                // Remplace le Mapper DzTask\Mapper\Task par SuiviProjet\Mapper\Task
                'dztask_task_mapper' => function ($serviceManager) {
                    $options = $serviceManager->get('dztask_module_options');
                    $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
                    $entityClass = $options->getTaskEntityClass();
                    return new Mapper\Task($entityManager, $entityClass);
                },
            ),
        );
    }
}
