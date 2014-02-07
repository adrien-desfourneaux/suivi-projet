<?php

/**
 * Fichier de source pour le TaskInterface
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/TaskInterface.php
 */

namespace SuiviProjet\Mapper;

/**
 * Interface pour le mapper de projet
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/TaskInterface.php
 */
interface TaskInterface extends \DzTask\Mapper\TaskInterface
{
    /**
     * Trouve des tâches selon leur id projet
     *
     * @param integer $id Identifiant du projet dont il faut trouver les tâches
     *
     * @return ArrayCollection
     */
    public function findByProjectId($id);
}
