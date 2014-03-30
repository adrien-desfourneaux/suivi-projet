<?php

/**
 * Ecoute les événements venant du module DzProjectModule
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Listener
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Listener/DzProjectListener.php
 */

namespace SuiviProjet\Listener;

use DzProjectModule\View\Listing\Field;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Ecouteur des événements venant du module DzProjectModule
 *
 * @category Source
 * @package  SuiviProjet\Listener
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Listener/DzProjectListener.php
 */
class DzProjectListener extends AbstractListenerAggregate
{
    /**
     * Gestionnaire de services.
     *
     * @var ServiceLocatorInterface
     */
    protected $locator;

    /**
     * Constructeur de DzProjectListener
     *
     * @param ServiceLocatorInterface $locator Gestionnaire de service.
     *
     * @return void
     */
    public function __construct($locator)
    {
        $this->locator = $locator;
    }

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

        // Evénement "Initialisation des champs de la liste des projets"
        $this->listeners[] = $sharedEvents->attach(
            'DzProjectModule\View\Listing\ProjectListing', 'init.post',
            array(
                $this,
                'onInitProjectListing'
            ), 100
        );
    }

    /**
     * Méthode de l'événement "Initialisation du listing des projets"
     * dzproject/list
     *
     * @param EventInterface $event Evénement déclenché
     *
     * @return void
     */
    public function onInitProjectListing($event)
    {
        $locator    = $this->locator;

        $listing    = $event->getTarget();
        $fields     = $listing->getFields();
        $projects   = $event->getParam('projects');

        $application = $locator->get('Application');
        $mvcEvent    = $application->getMvcEvent();
        $routeMatch  = $mvcEvent->getRouteMatch();

        $fields = $this->addFieldProjectManager($fields, $projects);
        $fields = $this->addLinksToProjectsTasks($fields, $projects);

        // Projets marqués uniquement sur la page de compte utilisateur
        if ($routeMatch->getMatchedRouteName() == 'dzuser/account') {
            $fields = $this->markProjectsByState($fields, $projects);
        }

        // Renvoyer les champs modifiés à la target
        $listing->setFields($fields);
    }

    /**
     * Ajoute le champ "Chef de projet" au listing des projets
     *
     * @param array $fields   Champs du listing
     * @param array $projects Projets du listing
     *
     * @return array Les champs modifiés du listing
     */
    protected function addFieldProjectManager($fields, $projects)
    {
        $field = new Field('Chef de projet');

        $locator = $this->locator;

        foreach ($projects as $project) {
            $id          = $project['project_id'];
            $displayName = $project['user']['display_name'];

            $field->values[$id] = $displayName;
        }

        // Le champ "Chef de projet" doit être en 2ème place (l'index commence à 0)
        array_splice($fields, 1, 0, array($field));

        return $fields;
    }

    /**
     * Ajoute les liens vers les tâches des projets
     *
     * @param array $fields   Champs du listing
     * @param array $projects Projets du listing
     *
     * @return array Les champs modifiés du listing
     */
    protected function addLinksToProjectsTasks($fields, $projects)
    {
        $locator   = $this->locator;

        $plugins   = $locator->get('ControllerPluginManager');
        $urlPlugin = $plugins->get('url');

        for ($i=0; $i<count($fields); $i++) {
            $fields[$i]['href'] = array();
            foreach ($projects as $p) {
                $id  = $p['project_id'];

                $url = $urlPlugin->fromRoute(
                    'dztask/list',
                    array(
                        'id' => $id,
                    )
                );

                $fields[$i]['href'][$id] = $url;
            }
        }

        return $fields;
    }

    /**
     * Marque les projets selon leur état
     * L'état d'un projet est déterminé selon l'état de l'ensemble de ses tâches
     *
     * @param array $fields   Champs du listing
     * @param array $projects Projets du listing
     *
     * @return array Les champs modifiés du listing
     */
    protected function markProjectsByState($fields, $projects)
    {
        for ($i=0; $i<count($fields); $i++) {
            $fields[$i]['class'] = array();
            foreach ($projects as $p) {
                $id    = $p['project_id'];
                $state = $p['state'];

                // L'état des projets est déterminé via le style des classes Bootstrap
                // Projet en retard marqués -> classe "danger"
                // Projet terminés en grisé -> classe "success"
                if ($state == 'late') {
                    $fiels[$i]['class'][$id] = "danger";
                } elseif ($state == 'done') {
                    $fields[$i]['class'][$id] = "active";
                }
            }
        }

        return $fields;
    }
}
