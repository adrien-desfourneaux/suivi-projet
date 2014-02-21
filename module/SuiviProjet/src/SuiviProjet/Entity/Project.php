<?php

/**
 * Fichier de source de l'entité projet
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Enitity/Project.php
 */

namespace SuiviProjet\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Exception;

/**
 * Project
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     http://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/Project.php
 *
 * @ORM\Table(name="project")
 * @ORM\Entity
 */
class Project
{
    use \DzProject\Entity\ProjectTrait,
        ProjectTrait;
}