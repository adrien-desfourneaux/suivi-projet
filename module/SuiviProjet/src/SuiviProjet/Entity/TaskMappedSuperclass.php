<?php

/**
 * Superclass mappée pour l'entité tâche.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Entity;

use Doctrine\ORM\Mapping as ORM;

use DzTaskModule\Entity\TaskMappedSuperclass as DzTaskMappedSuperclass;


/**
 * Superclass mappée pour l'entité tâche.
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 *
 * @ORM\MappedSuperclass
 */
class TaskMappedSuperclass extends DzTaskMappedSuperclass
{
    /**
     * Identifiant du du projet associé à cette tâche.
     *
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false)
     */
    protected $projectId;

    /**
     * Lien vers le projet associé à cette tâche.
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="project_id")
     */
    protected $project;

    /**
     * Obtient l'id du projet associé à cette tâche
     *
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Obtient le projet associé à cette tâche
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Définit le projet associé à cette tâche
     *
     * @param Project $project Le nouveau projet associé
     *
     * @return Task
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }
}
