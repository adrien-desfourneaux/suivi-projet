<?php

/**
 * Classe pour WebHelper de Projet qui utilise les méthodes de Db
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Test\Helper;

use DzProjectModule\Test\Helper\DbWebHelper as DzProjectDbWebHelper;

/**
 * Classe pour WebHelper qui utilise les méthodes de Db.
 *
 * Contient des méthodes helpers pour tout ce qui touche aux projets.
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class ProjectDbWebHelper extends DzProjectDbWebHelper
{
    /**
     * {@inheritdoc}
     *
     * @todo
     */
    public function seeProjectMarked($projectDisplayName)
    {
        $browser = $this->getModule('PhpBrowser');
        $browser->grabTextFrom('');
    }
}
