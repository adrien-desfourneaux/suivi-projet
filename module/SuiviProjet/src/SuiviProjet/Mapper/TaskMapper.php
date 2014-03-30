<?php

/**
 * Fichier de source pour le TaskMapper
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Mapper;

use DzTaskModule\Mapper\TaskMapper as DzTaskMapper;

/**
 * Mapper pour les taches.
*
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class TaskMapper extends DzTaskMapper implements TaskMapperInterface
{
    /**
     * Trouve des tâches selon leur id projet.
     *
     * @param integer $id Identifiant du projet.
     *
     * @return ArrayCollection
     */
    /*public function findByProjectId($id)
    {
        return $this->getRepository()
            ->findByProjectId($id);
    }*/
}
