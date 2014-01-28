<?php

/**
 * ProjectServiceFactory source
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Service
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Service/ProjectServiceFactory.php
 */

namespace SuiviProjet\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use DzProject\Service\ProjectService;
use DzProject\Model\ProjectManager;
use SuiviProjet\Model\ProjectRepository;

/**
 * Factory qui construit le Service pour les projets.
 *
 * @category Source
 * @package  DzProject\Service
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     http://github.com/adrien-desfourneaux/suivi-projet/tree/master/src/SuiviProjet/Service/ProjectServiceFactory.php
 * @see      FactoryInterface
 */
class ProjectServiceFactory implements
    FactoryInterface
{
    /**
     * Create service
     * 
     * @param ServiceLocatorInterface $serviceLocator Instance of ServiceLocatorInterface
     *
     * @return ProjectService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ProjectService(
            new ProjectManager($serviceLocator->get('doctrine.entitymanager.orm_default')),
            new ProjectRepository($serviceLocator->get('doctrine.entitymanager.orm_default'))
        );
    } 
}
