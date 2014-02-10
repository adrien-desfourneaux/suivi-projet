<?php

/**
 * Fichier de source du TaskController
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/TaskController.php
 */

namespace SuiviProjet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Classe contrôleur de tâches
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Controller/TaskController.php
 */
class TaskController extends \DzTask\Controller\TaskController
{
    /**
     * Affiche toutes les taches
     * ROUTE: /task/show-all/:id
     * GET id Identifiant du projet dont il faut afficher les tâches
     *
     * @return ViewModel
     */
    public function showallAction()
    {
        $id = $this->params()
            ->fromRoute('id');

        $tasks = $this->getTaskService()
            ->getTaskMapper()
            ->findByProjectId($id);

        return new ViewModel(
            array(
                'tasks' => $tasks
            )
        );
    }
}
