<?php

/**
 * Fichier de source pour le ProjectMapperInterface
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

use Doctrine\Common\Collections\ArrayCollection;

use DzProjectModule\Mapper\ProjectMapperInterface as DzProjectMapperInterface;

use Zend\Authentication\AuthenticationService;

/**
 * Interface pour le mapper de projet
 *
 * @category Source
 * @package  SuiviProjet\Mapper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
interface ProjectMapperInterface extends DzProjectMapperInterface
{
    /**
     * Trouve les projets suivis par l'utilisateur connecté
     *
     * @return ArrayCollection
     */
    public function findFollowed();

    /**
     * Définit le service d'authentification
     *
     * @param AuthenticationService $authService Nouveau service.
     *
     * @return ProjectMapperInterface
     */
    public function setAuthService($authService);

    /**
     * Obtient le service d'authentification
     *
     * @return AuthenticationService
     */
    public function getAuthService();
}
