<?php

/**
 * Fichier de source du UserController
 * Etend DzUser\Controller\UserController
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/UserController.php
 */

namespace SuiviProjet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Classe contrôleur utilisateur
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/UserController.php
 */
class UserController extends \DzUser\Controller\UserController
{
    /**
     * Compte de l'utlisateur connecté
     * ROUTE: dzuser/account
     * URL: /user/account
     *
     * @return ViewModel
     */
    public function accountAction()
    {
        return new ViewModel();
    }
}
