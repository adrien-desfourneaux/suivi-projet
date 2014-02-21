<?php

/**
 * Trait pour WebHelper qui utilise les méthodes de Db
 * 
 * PHP version 5.4.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/WebHelperDbTrait.php
 */

namespace SuiviProjet\Test\Helper;

/**
 * Trait pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/WebHelperDbTrait.php
 */
trait WebHelperDbTrait
{
    /**
     * Définit les relations entre les projets et les utilisateurs
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultProjectsUserRelationsInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $db = new \SuiviProjet\Test\Helper\Db($dbh);
        $db->setProjectsUserRelations();
    }

    /**
     * Définit les relations entre les projets et les tâches
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTasksProjectRelationsInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $db = new \SuiviProjet\Test\Helper\Db($dbh);
        $db->setTasksProjectRelations();
    }

    /**
     * Définit tout par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveAllDefaultsInDatabase()
    {
        $dbh = $this->getModule('Db')->dbh;
        $modules = array(
            'DzProject',
            'DzTask',
            'DzUser',
            'SuiviProjet'
        );

        foreach ($modules as $module) {
            $class = $module.'\Test\Helper\Db';
            $db = new $class($dbh);
            $db->execDumpFile();
        }
    }
}
