<?php

/**
 * Fichier source pour le ProjectMapperFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Factory;

use DzProjectModule\Factory\ProjectMapperFactory as DzProjectMapperFactory;
use SuiviProjet\Mapper\ProjectMapper;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe ProjectMapperFactory.
 *
 * Classe usine pour le mappeur de projets.
 *
 * @category Source
 * @package  SuiviProjet\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class ProjectMapperFactory extends DzProjectMapperFactory
{
    /**
     * {@inheritdoc}
     */
    const MAPPER_CLASS = 'SuiviProjet\Mapper\ProjectMapper';

    /**
     * Cré et retourne le mappeur de projets.
     *
     * @param ServiceLocatorInterface $serviceLocator Localisateur de service.
     *
     * @return ProjectMapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authService = $serviceLocator->get('zfcuser_auth_service');

        $mapper = parent::createService($serviceLocator);
        $mapper->setEntityClass('SuiviProjet\Entity\Project');
        $mapper->setAuthService($authService);

        return $mapper;
    }
}
