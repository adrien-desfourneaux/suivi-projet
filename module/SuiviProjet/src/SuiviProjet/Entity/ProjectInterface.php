<?php

/**
 * Interface pour l'entité projet
 *
 * PHP version 5.3.3
 *
 * @category Interface
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/ProjectInterface.php
 */

namespace SuiviProjet\Entity;

/**
 * Interface pour l'entité projet
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/ProjectInterface.php
 */
interface ProjectInterface extends \DzProject\Entity\ProjectInterface
{
    /**
     * Obtient l'id du chef de projet.
     *
     * @return integer 
     */
    public function getUserId();

    /**
     * Obtient le chef du projet
     *
     * @return \ZfcUserDoctrineORM\Entity\User
     */
    public function getUser();
}
