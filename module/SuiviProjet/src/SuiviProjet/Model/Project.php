<?php

/**
 * Project entity
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Model/Project.php
 */

namespace SuiviProjet\Model;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Exception;

/**
 * Project
 *
 * @category Source
 * @package  SuiviProjet\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     http://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Model/Project.php
 *
 * @ORM\Table(name="project")
 * @ORM\Entity
 */
class Project extends \DzProject\Model\Project
{
    /**
     * Identifiant du chef du projet
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $userId;

    /**
     * Définit l'id du chef du projet.
     *
     * @param integer $userId Id du chef du projet
     *
     * @return Project
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Obtient l'id du chef de projet.
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
