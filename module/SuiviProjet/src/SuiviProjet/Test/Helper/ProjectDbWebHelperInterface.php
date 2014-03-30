<?php

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Test\Helper;

use DzProjectModule\Test\Helper\DbWebHelperInterface as DzProjectDbWebHelperInterface;

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
interface ProjectDbWebHelperInterface extends DzProjectDbWebHelperInterface
{
    /**
     * Vérifie que le projet qui possède la désignation passée
     * en paramètre est marqué
     *
     * @param string $projectDisplayName Nom du projet qu'il faut vérifier
     *
     * @return void
     */
    public function seeProjectMarked($projectDisplayName);
}
