<?php

/**
 * Fichier de source du IndexController
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/IndexController.php
 */

namespace SuiviProjet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Classe contrôleur principal
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/IndexController.php
 */
class IndexController extends AbstractActionController
{
    const ROUTE_INDEX = '/';
    
    const CONTROLLER_NAME    = 'index';

    /**
     * Affiche la liste des projets actifs
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
