<?php

/**
 * Fichier de source pour le Task Mapper
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/Task.php
 */

namespace SuiviProjet\Mapper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Mapper pour les taches.
*
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/Task.php
 */
class Task extends \DzTask\Mapper\Task implements TaskInterface
{
    /**
     * Trouve des tâches selon leur id projet
     *
     * @param integer $id Identifiant du projet dont il faut trouver les tâches
     *
     * @return ArrayCollection
     */
    public function findByProjectId($id)
    {
        return $this->getRepository()
            ->findByProjectId($id);
    }
}
