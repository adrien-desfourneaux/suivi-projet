<?php

/**
 * Stratégie pour l'association vers l'utilisateur
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Strategy
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Hydrator/Strategy/UserAssociation.php
 */

namespace SuiviProjet\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Stratégie d'hydrateur de conversion d'une entité Doctrine User en array (extraction)
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Strategy
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Hydrator/Strategy/UserAssociation.php
 */
class UserAssociation extends DefaultStrategy
{
    /**
     * Convertit la collection d'entités Doctrine Task en array
     * extract: $object -> array()
     *
     * @param mixed $value Attend une collection d'entités Task
     *
     * @return mixed Renvoie le tableau des extractions
     */
    public function extract($value)
    {
        if (is_object($value)) {
            $hydrator = new ClassMethods();
            $value = $hydrator->extract($value);
        }

        return $value;
    }
}
