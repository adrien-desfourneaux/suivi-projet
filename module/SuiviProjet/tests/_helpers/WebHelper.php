<?php

/**
 * Aides pour les tests d'acceptation
 *
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Helper
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/_helpers/WebHelper.php
 */

namespace Codeception\Module;

use Codeception\Module;

use SuiviProjet\Test\Helper\ProjectDbWebHelper;
use SuiviProjet\Test\Helper\ProjectDbWebHelperInterface;

use DzTaskModule\Test\Helper\DbWebHelper as TaskDbWebHelper;
use DzTaskModule\Test\Helper\DbWebHelperInterface as TaskDbWebHelperInterface;

use DzUserModule\Test\Helper\DbWebHelper as UserDbWebHelper;
use DzUserModule\Test\Helper\DbWebHelperInterface as UserDbWebHelperInterface;

use SuiviProjet\Test\Helper\DbWebHelper as SuiviProjetDbWebHelper;
use SuiviProjet\Test\Helper\DbWebHelperInterface as SuiviProjetDbWebHelperInterface;

/**
 * Classe helper pour les tests d'acceptance.
 *
 * Fonctions personnalisés pour le WebGuy.
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Helper
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT Licensej
 * @link       https://github.com/adrien-desfourneaux/suivi-projet
 */
class WebHelper extends Module implements
    ProjectDbWebHelperInterface,
    TaskDbWebHelperInterface,
    UserDbWebHelperInterface,
    SuiviProjetDbWebHelperInterface
{
    /**
     * Helper pour les méthodes de Db de Projet.
     *
     * @var ProjectDbWebHelper
     */
    protected $projectDbHelper;

    /**
     * Helper pour les méthodes de Db de Tâche.
     *
     * @var TaskDbWebHelper
     */
    protected $taskDbHelper;

    /**
     * Helper pour les méthodes de Db d'Utilisateur.
     *
     * @var UserDbWebHelper
     */
    protected $userDbHelper;

    /**
     * Helper pour les méthodes de Db de SuiviProjet.
     *
     * @var SuiviProjetDbWebHelper
     */
    protected $dbHelper;

    /**
     * Initialisation du Helper.
     *
     * @return void
     */
    public function _initialize()
    {
        parent::_initialize();

        $dbModule = $this->getModule('Db');

        $this->projectDbHelper = new ProjectDbWebHelper($dbModule);
        $this->taskDbHelper    = new TaskDbWebHelper($dbModule);
        $this->userDbHelper    = new UserDbWebHelper($dbModule);
        $this->dbHelper = new DbWebHelper($dbModule);
    }

    // ------------------ Project ------------------

    /**
     * {@inheritdoc}
     */
    public function haveDefaultProjectsInDatabase()
    {
        return $this->projectDbHelper->haveDefaultProjectsInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllProjectDefaultsInDatabase()
    {
        return $this->projectHelper->haveAllProjectDefaultsInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function seeProjectMarked($projectDisplayName)
    {
        return $this->projectHelper->seeProjectMarked($projectDisplayName);
    }

    // ------------------ Task ------------------

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTaskStatesInDatabase()
    {
        return $this->taskDbHelper->haveDefaultTaskStatesInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTasksInDatabase()
    {
        return $this->taskDbHelper->haveDefaultTasksInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllTaskDefaultsInDatabase()
    {
        return $this->taskDbHelper->haveAllTaskDefaultsInDatabase();
    }

    // ------------------ User ------------------

    /**
     * {@inheritdoc}
     */
    public function haveDefaultUserRolesInDatabase()
    {
        return $this->userDbHelper->haveDefaultUserRolesInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultUsersInDatabase()
    {
        return $this->userDbHelper->haveDefaultUsersInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultUserRoleLinkersInDatabase()
    {
        return $this->userDbHelper->haveDefaultUserRoleLinkersInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllUserDefaultsInDatabase()
    {
        return $this->userDbHelper->haveAllUserDefaultsInDatabase();
    }

    // ------------------ SuiviProjet ------------------

    /**
     * {@inheritdoc}
     */
    public function haveDefaultProjectsUserRelationsInDatabase()
    {
        return $this->dbHelper->haveDefaultProjectsUserRelationsInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTasksProjectRelationsInDatabase()
    {
        return $this->dbHelper->haveDefaultTasksProjectRelationsInDatabase();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllSuiviProjetDefaultsInDatabase()
    {
        return $this->dbHelper->haveAllSuiviProjetDefaultsInDatabase();
    }
}
