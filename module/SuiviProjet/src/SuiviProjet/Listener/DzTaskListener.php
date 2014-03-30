<?php

/**
 * Ecoute les événements venant du module DzTaskModule
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Listener
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Listener/DzTaskListener.php
 */

namespace SuiviProjet\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Ecouteur des événements venant du module DzTaskModule
 *
 * @category Source
 * @package  SuiviProjet\Listener
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Listener/DzTaskListener.php
 */
class DzTaskListener extends AbstractListenerAggregate implements ServiceLocatorAwareInterface
{
    /**
     * Instance de ServiceLocator
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Attache un ou plusieurs écouteurs
     *
     * @param EventManagerInterface $events Instance de EventManager
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();

        // Evénement "Initialisation du formulaire d'ajout de tâche"
        $this->listeners[] = $sharedEvents->attach(
            'DzTaskModule\Form\Add', 'init',
            array(
                $this,
                'onInitAddForm'
            ), 100
        );

        // Evénement "Ajout d'une nouvelle tâche depuis le service"
        $this->listeners[] = $sharedEvents->attach(
            'DzTaskModule\Service\Task', 'add',
            array(
                $this,
                'onAddTaskFromService'
            ), 100
        );
    }

    /**
     * Méthode de l'événement "Initialisation du formulaire d'ajout de tâche"
     *
     * @param EventInterface $e Evénement déclenché
     *
     * @return void
     */
    public function onInitAddForm($e)
    {
        $form = $e->getTarget();

        // Ajouter le champs caché projectId au formulaire d'ajout de tâche
        $form->add(
            array(
                'type' => 'Zend\Form\Element\Hidden',
                'name' => 'projectId',
            )
        );
    }

    /**
     * Méthode de l'événement "Ajout d'une nouvelle tâche depuis le service"
     *
     * @param EventInterface $e Evénément déclenché
     *
     * @return void
     */
    public function onAddTaskFromService($e)
    {
        $task = $e->getParam('task');
        $form = $e->getParam('form');

        // Avant l'ajout d'une nouvelle tâche, définir son projet associé
        $id = $form->get('projectId')->getValue();
        $mapper = $this->getServiceLocator()->get('dzproject_project_mapper');
        $project = $mapper->findById($id);

        $task->setProject($project);
    }

    /**
     * Définit le ServiceLocator
     *
     * @param ServiceLocatorInterface $serviceLocator Nouveau ServiceLocator
     *
     * @return DzTaskListener
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /**
     * Obtient le ServiceLocator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
