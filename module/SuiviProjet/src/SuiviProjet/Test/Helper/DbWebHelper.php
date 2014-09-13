<?php

/**
 * Classe pour WebHelper qui utilise les méthodes de Db
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Test\Helper;

/**
 * Classe pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class DbWebHelper implements DbWebHelperInterface
{
    /**
     * Module Codeception de base de données.
     *
     * @var DbModule
     */
    protected $db;

    /**
     * Constructeur de DbWebHelper
     *
     * @param DbModule $db Module de Base de données.
     *
     * @return void
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultProjectsUserRelationsInDatabase()
    {
        $dbh = $this->db->dbh;
        $db = new Db($dbh);
        $db->setProjectsUserRelations();
    }

    /**
     * {@inheritdoc}
     */
    public function haveDefaultTasksProjectRelationsInDatabase()
    {
        $dbh = $this->db->dbh;
        $db = new Db($dbh);
        $db->setTasksProjectRelations();
    }

    /**
     * {@inheritdoc}
     */
    public function haveAllSuiviProjetDefaultsInDatabase()
    {
        $dbh = $this->db->dbh;
        $modules = array(
            'DzProjectModule',
            'DzTaskModule',
            'DzUserModule',
            'SuiviProjet'
        );

        foreach ($modules as $module) {
            $class = $module.'\Test\Helper\Db';
            $db = new $class($dbh);
            $db->execDumpFile();
        }
    }
}
