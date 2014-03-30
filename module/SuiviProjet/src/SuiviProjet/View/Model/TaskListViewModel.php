<?php

/**
 * Fichier de source du TaskListViewModel.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\View\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\View\Model;

use DzTaskModule\View\Model\ListViewModel;
use DzTaskModule\View\Listing\TaskListing;

/**
 * Classe TaskListViewModel.
 * Vue-Modèle pour le listing de tâches.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\View\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class TaskListViewModel extends ListViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $defaults = array(
        // Nouveau! Identifiant du
        // projet des tâches
        'id'              => false,

        'hasTitle'        => true,
        'hasAddAction'    => true,
        'hasDeleteAction' => true,
        'isWidget'        => false,
    );

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $messagePlugin          = $this->plugin('message');
        $messageExceptionPlugin = $this->plugin('messageException');

        $id      = $this->getVariable('id');
        $service = $this->getService();
        $tasks   = $service->findByProjectId($id);

        $listing = new TaskListing();
        $listing->setTasks($tasks);
        $listing->init();

        /*if (!$tasks) {
            $message = $messagePlugin('no task');
        }*/

        $fields  = $listing->getFields();
        $tasks   = $listing->getTasks();

        $this->setVariable('tasks', $tasks);
        $this->setVariable('fields', $fields);
    }
}
