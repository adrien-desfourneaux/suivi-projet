<?php

/**
 * Fichier source pour le ProjectHydratorFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/SuiviProjet
 */

namespace SuiviProjet\Hydrator\Factory;

use DzProjectModule\Hydrator\Factory\ProjectHydratorFactory as DzProjectHydratorFactory;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe ProjectHydratorFactory.
 *
 * Classe usine pour l'hydrateur de projets.
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/SuiviProjet
 */
class ProjectHydratorFactory extends DzProjectHydratorFactory
{
    /**
     * Cré et retourne l'hydrateur de projets.
     *
     * Ajoute des stratégies à l'hydrateur de projets pour
     * manipuler son utilisateur et ses tâches commes des tableaux.
     *
     * @param ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return ProjectHydrator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = parent::createService($serviceLocator);

        $locator   = $serviceLocator->getServiceLocator();
        $userLink  = $locator->get('SuiviProjet\UserAssociationStrategy');
        $tasksLink = $locator->get('SuiviProjet\TasksAssociationStrategy');

        // hydratation
        $hydrator->addStrategy('user', $userLink);
        $hydrator->addStrategy('tasks', $tasksLink);

        return $hydrator;
    }
}
