<?php

/**
 * Fichier de source pour le ProjectInterface
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/ProjectInterface.php
 */

namespace SuiviProjet\Mapper;

/**
 * Interface pour le mapper de projet
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/SuiviProjet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/ProjectInterface.php
 */
interface ProjectInterface extends \DzProject\Mapper\ProjectInterface
{
    /**
     * Trouve les projets suivis par l'utilisateur connecté
     *
     * @return \Doctrine\ORM\Common\Collections\ArrayCollection
     */
    public function findFollowed();
}
