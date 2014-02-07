<?php

/**
 * Fichier de source pour le ProjectMapper
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/Project.php
 */

namespace SuiviProjet\Mapper;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService;

/**
 * Mapper pour les projets.
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/SuiviProjet/tree/master/module/SuiviProjet/src/SuiviProjet/Mapper/Project.php
 */
class Project extends \DzProject\Mapper\Project implements ProjectInterface
{
    /**
     * Constructeur de ProjectMapper.
     *
     * @param EntityManager         $entityManager Instance de EntityManager
     * @param string                $entityClass   Nom de la classe de l'entité projet
     * @param AuthenticationService $authService   Service d'authentification
     */
    public function __construct($entityManager, $entityClass, $authService)
    {
        parent::__construct($entityManager, $entityClass);

        $this->authService = $authService;
    }

    /**
     * Trouve des projets selon leur type
     * 
     * @param string $type Type des projets à trouver
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findByType($type)
    {
        if ($type == 'followed') {
            return $this->findFollowed();
        }

        return parent::findByType($type);
    }

    /**
     * Trouve les projets suivis par l'utilisateur connecté
     *
     * @return \Doctrine\ORM\Common\Collections\ArrayCollection
     */
    public function findFollowed()
    {
        $projects = $this->getRepository()->findByUserId($this->getAuthService()->getIdentity()->getId());

        usort($projects, function ($a, $b) {
            if ($a->getEndDate() == $b->getEndDate()) return 0;
            return ($a->getEndDate() > $b->getEndDate()) ? 1 : 0;
        });

        return $projects;
    }

    /**
     * Obtient le service d'authentification
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Définit le service d'authentification
     *
     * @param AuthenticationService $authService Nouveau service d'authentification
     *
     * @return Project
     */
    public function setAuthService($authService)
    {
        $this->authService = $authService;
        return $this;
    }
}
