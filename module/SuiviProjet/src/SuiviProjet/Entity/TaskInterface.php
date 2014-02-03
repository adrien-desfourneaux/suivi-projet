<?php

/**
 * Interface pour l'entité tache
 *
 * PHP version 5.3.3
 *
 * @category Interface
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/TaskInterface.php
 */

namespace SuiviProjet\Entity;

/**
 * Interface pour l'entité tache
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/TaskInterface.php
 */
interface TaskInterface extends \DzTask\Entity\TaskInterface
{
    /**
     * Obtient l'id du projet associé à cette tache.
     *
     * @return integer 
     */
    public function getProjectId();

    /**
     * Obtient le projet associé à cette tache.
     *
     * @return Project 
     */
    public function getProject();
}
