<?php

/**
 * Fichier de source de l'entité projet
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Enitity/Project.php
 */

namespace SuiviProjet\Entity;

use Doctrine\ORM\Mapping as ORM;
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
class Project extends \DzProject\Entity\Project implements ProjectInterface
{
    /**
     * Identifiant du chef du projet
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    protected $userId;

    /**
     * Lien vers le chef du projet
     * 
     * @ORM\ManyToOne(targetEntity="ZfcUserDoctrineORM\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;

    /**
     * Obtient l'id du chef de projet.
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Obtient le chef du projet
     *
     * @return \ZfcUserDoctrineORM\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
