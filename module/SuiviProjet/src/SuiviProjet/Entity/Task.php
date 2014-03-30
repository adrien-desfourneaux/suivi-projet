<?php

/**
 * Fichier de source de l'entité tâche
 *
 * PHP version 5.4.0
 *
 * @category Source
 * @package  SuiviProjet\Entity
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Enitity/Task.php
 */

namespace SuiviProjet\Entity;

use Doctrine\ORM\Mapping as ORM;

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
class Task extends TaskMappedSuperclass
{
}
