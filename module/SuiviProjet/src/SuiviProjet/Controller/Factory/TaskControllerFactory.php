<?php

/**
 * Fichier source pour le TaskControllerFactory.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Controller\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Controller\Factory;

use SuiviProjet\Controller\TaskController;

use DzTaskModule\Controller\Factory\TaskControllerFactory as DzTaskControllerFactory;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Classe TaskControllerFactory.
 *
 * Classe usine pour le controller de tâches.
 *
 * @category Source
 * @package  SuiviProjet\Controller\Factory
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class TaskControllerFactory extends DzTaskControllerFactory
{
    /**
     * {@inheritdoc}
     */
    const CONTROLLER_CLASS = 'SuiviProjet\Controller\TaskController';

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = parent::createService($serviceLocator);

        return $controller;
    }
}
