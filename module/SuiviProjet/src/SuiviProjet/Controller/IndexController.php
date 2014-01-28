<?php
/**
 * ProjectController source
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
 * Classe contrôleur de l'application.
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/IndexController.php
 * @see      AbstractActionController Contrôleur d'actions abstrait.
 */
class IndexController extends AbstractActionController
{
    /**
     * Action par défaut de l'IndexController.
     *
     * @return ViewModel Les données à retourner à la vue.
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}
