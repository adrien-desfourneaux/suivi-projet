<?php

/**
 * Fichier de source pour le TaskMapperInterface
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

use Doctrine\Common\Collections\ArrayCollection;

use DzTaskModule\Mapper\TaskMapperInterface as DzTaskMapperInterface;

/**
 * Interface pour le mapper de projet
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
interface TaskMapperInterface extends DzTaskMapperInterface
{
    /**
     * Trouve des tâches selon leur id projet
     *
     * @param integer $id Identifiant du projet dont il faut trouver les tâches
     *
     * @return ArrayCollection
     */
    //public function findByProjectId($id);
}
