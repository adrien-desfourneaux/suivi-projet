<?php

/**
 * Spécification de l'entité Project
 *
 * PHP version 5.3.3
 *
 * @category Spec
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/spec/SuiviProjet/Entity/ProjectSpec.php
 */

namespace spec\SuiviProjet\Entity;

use PhpSpec\ObjectBehavior;

/**
 * Classe de spécification du comportement
 * de l'entité projet.
 *
 * @category Spec
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/spec/SuiviProjet/Entity/ProjectSpec.php
 * @see      ObjectBehavior
 */
class ProjectSpec extends \spec\DzProjectModule\Entity\ProjectSpec
{
    /**
     * Le Project doit être initialisable.
     *
     * @return null
     */
    public function it_is_initializable()
    {
        $this->shouldHaveType('SuiviProjet\Entity\Project');
    }

    /**
     * Le Project doit avoir un attribut userId
     * disponible en lecture.
     *
     * @return null
     */
    public function it_has_a_readonly_user_id()
    {
        $this->getUserId();
    }
}
