<?php

/**
 * Fichier de source de l'entité tache
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Enitity/Task.php
 */

namespace SuiviProjet\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Exception;

/**
 * Task
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     http://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/Task.php
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task extends \DzTask\Entity\Task implements TaskInterface
{
    /**
     * Identifiant du du projet associé à cette tache
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false)
     */
    protected $projectId;

    /**
     * Lien vers le projet associé à cette tache
     * 
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     */
    protected $project;

    /**
     * Obtient l'id du projet associé à cette tache
     *
     * @return integer 
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Obtient le projet associé à cette tache
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
