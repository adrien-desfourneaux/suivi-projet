<?php

/**
 * Méthodes d'aide d'insertion de données
 * depuis les fichiers data/*.sql
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/Db.php
 */

namespace SuiviProjet\Test\Helper;

/**
 * Méthodes d'aide d'insertion de données
 * depuis les fichiers data/*.dump.sqlite.sql
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/Db.php
 */
class Db
{
    /**
     * Connection PDO
     * @var \PDO
     */
    protected $dbh;

    /**
     * Chemin vers le fichier de dump
     * @var string
     */
    protected $dumpFile;

    /**
     * Constructeur de Db
     *
     * @param \PDO $dbh Connection PDO
     *
     * @return void
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
        $this->dumpFile = __DIR__ . '/../../../../data/suiviprojet.dump.sqlite.sql';
    }

    /**
     * Définit les relations entre les projets et les utilisateurs
     * dans la base de données
     *
     * @return void
     */
    public function setProjectsUserRelations()
    {
        $sql = file_get_contents($this->getDumpFile());

        preg_match_all("/UPDATE '?project'? SET '?user_id'? = .*?WHERE '?project_id'? = .*?;/s", $sql, $matches);
        $inserts = $matches[0];

        foreach ($inserts as $insert) {
            $this->dbh->exec($insert);
        }
    }

    /**
     * Définit les relations entre les projets et les tâches
     * dans la base de données
     *
     * @return void
     */
    public function setTasksProjectRelations()
    {
        $sql = file_get_contents($this->getDumpFile());

        preg_match_all("/UPDATE '?task'? SET '?project_id'? = .*?WHERE '?task_id'? = .*?;/s", $sql, $matches);
        $inserts = $matches[0];

        foreach ($inserts as $insert) {
            $this->dbh->exec($insert);
        }
    }

    /**
     * Exécute le fichier de dump
     *
     * @return void
     */
    public function execDumpFile()
    {
        $sql = file_get_contents($this->getDumpFile());
        echo $sql;

        $this->dbh->exec($sql);
    }

    /**
     * Obtient le chemin vers le fichier de dump
     *
     * @return string
     */
    public function getDumpFile()
    {
        return $this->dumpFile;
    }

    /**
     * Définit le chemin vers le fichier de dump
     *
     * @param string $dumpFile Nouveau chemin
     *
     * @return \SuiviProjet\Test\Helper\Db
     */
    public function setDumpFile($dumpFile)
    {
        $this->dumpFile = $dumpFile;

        return $this;
    }
}
