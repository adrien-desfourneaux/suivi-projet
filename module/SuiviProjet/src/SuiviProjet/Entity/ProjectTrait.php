<?php

/**
 * Trait pour l'entité projet
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/ProjectTrait.php
 */

namespace SuiviProjet\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trait pour l'entité projet
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Entity/ProjectTrait.php
 */
trait ProjectTrait
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
     * @ORM\ManyToOne(targetEntity="DzUser\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;

    /**
     * Lien vers les tâches du projet
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="project")
     */
    protected $tasks;

    /**
     * Constructeur de l'entité Projet
     *
     * @return void
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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

    /**
     * Obtient le chef du projet
     *
     * @return \DzUser\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Obtient les tâches du projet
     *
     * @return array
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Obtient l'état du projet
     *
     * @return string Etat du projet
     *                En cours     "in-progress"
     *                Pas commencé "not-started"
     *                En retard    "late"
     *                Terminé      "done"
     */
    public function getState()
    {
        $values["done"] = 0.5;
        $values["not-started"] = 0.5;
        $values["in-progress"] = 1;
        $values["late"] = 2;

        if (count($this->tasks) == 0) {
            return 'not-started';
        }

        $val = $values[$this->tasks[0]->getState()->getLabel()];

        for ($i=1; $i<count($this->tasks); $i++) {
            if ($values[$this->tasks[$i]->getState()->getLabel()] > $val) {
                $val = $values[$this->tasks[$i]->getState()->getLabel()];
            } else if ($values[$this->tasks[$i]->getState()->getLabel()] == 0.5 && $val == 0.5) {
                $val = 1;
            }
        }

        foreach ($values as $state => $value) {
            if ($val == $value) return $state;
        }

        // ERREUR!
        throw Exception("Mauvaises valeurs des états de tâches en base de données");
    }
}
