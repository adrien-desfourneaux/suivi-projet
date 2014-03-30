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
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Mapper;

use DzProjectModule\Mapper\ProjectMapper as DzProjectMapper;

use Zend\Authentication\AuthenticationService;

/**
 * Mapper pour les projets.
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class ProjectMapper extends DzProjectMapper implements ProjectMapperInterface
{
    /**
     * Service d'autentification.
     *
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * {@inheritdoc}
     */
    public function findByType($type)
    {
        if ($type == 'followed') {
            return $this->findFollowed();
        }

        return parent::findByType($type);
    }

    /**
     * {@inheritdoc}
     */
    public function findFollowed()
    {
        $authService = $this->getAuthService();
        $repository  = $this->getRepository();

        $user = $authService->getIdentity();
        $id   = $user->getId();

        $projects = $repository->findByUserId($id);

        usort(
            $projects, function ($el1, $el2) {
                if ($el1->getEndDate() == $el2->getEndDate()) return 0;
                return ($el1->getEndDate() > $el2->getEndDate()) ? 1 : 0;
            }
        );

        return $projects;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthService($authService)
    {
        $this->authService = $authService;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthService()
    {
        return $this->authService;
    }
}
