<?php

/**
 * Fichier de source du TaskController
 * Etend DzTaskModule\Controller\TaskController
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Controller;

use DzTaskModule\Controller\TaskController as DzTaskController;

use Zend\View\Model\ModelInterface;

/**
 * Classe contrôleur de tâches
 *
 * @category Source
 * @package  SuiviProjet\Controller
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class TaskController extends DzTaskController
{
    /**
     * Envoie le formulaire d'ajout de tâche
     * Traite en retour les données du formulaire
     * Spécialisation de \DzTaskModule\Controller\TaskController::addAction()
     * avec en plus l'ajout de la tâche dans un projet particulier.
     *
     * ROUTE: /task/add/:id
     *
     * @return ModelInterface
     */
    public function addAction()
    {
        $id = $this->params()->fromRoute('id');

        $return = parent::addAction();

        if (is_array($return)) {
            $viewModel = new ViewModel($return);
        } elseif ($return instanceof ViewModel) {
            $viewModel = $return;
        } else {
            return $return;
        }

        // Ajout de l'identifiant du projet associé
        // à la tâche
        $viewModel->getVariable('addForm')->get('projectId')->setValue($id);

        // On garde le template d'origine
        $viewModel->setTemplate('dz-task-module/task/add.phtml');

        return $viewModel;
    }

    /**
     * Affiche toutes les taches
     * ROUTE: /task/list/:id
     * GET id Identifiant du projet dont il faut afficher les tâches
     *
     * @return ModelInterface
     */
    public function listAction()
    {
        $id = $this->params()->fromRoute('id');

        $viewModel = parent::listAction();
        $viewModel->setVariable('id', $id);

        return $viewModel;
    }
}
