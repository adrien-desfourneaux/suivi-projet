<?php

/**
 * Stratégie pour l'association vers des tâches
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Strategy
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Hydrator/Strategy/TasksAssociationStrategy.php
 */

namespace SuiviProjet\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Stratégie d'hydrateur de conversion d'une collection d'entités Doctrine Task en array (extraction)
 *
 * @category Source
 * @package  SuiviProjet\Hydrator\Strategy
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Hydrator/Strategy/TasksAssociationStrategy.php
 */
class TasksAssociationStrategy extends DefaultStrategy
{
    /**
     * Convertit la collection d'entités Doctrine Task en array
     * extract: object -> array()
     *
     * @param mixed $value Attend une collection d'entités Task
     *
     * @return mixed Renvoie le tableau des extractions
     */
    public function extract($value)
    {
        if ($value instanceof \Doctrine\ORM\PersistentCollection) {

            $hydrator = new ClassMethods();
            $value = $value->toArray();

            for ($i=0; $i<count($value); $i++) {
                $value[$i] = $hydrator->extract($value[$i]);
            }

            return $value;
        } else {
            return $value;
        }
    }

    /**
     * Convertit l'array $value en Collection Doctrine d'entités Tasks
     *
     * @param mixed $value Attend un array contenant les tâches
     *
     * @return mixed La collection ArrayCollection correspondante
     */
    public function hydrate($value)
    {
        if (!is_array($value) || !isset($value['tasks'])) {
            return $value;
        }

        $hydrator = new ClassMethods();

        $ret = new \Doctrine\Common\Collections\ArrayCollection();
        for ($i=0; $i<count($value['tasks']); $i++) {
            $ret[$i] = $hydrator->hydrate($value['tasks'][$i]);
        }

        return $ret;
    }
}
