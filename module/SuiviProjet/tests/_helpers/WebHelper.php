<?php

/**
 * Aides pour les tests d'acceptation
 * 
 * PHP version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Helper
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/_helpers/WebHelper.php
 */

namespace Codeception\Module;

use DzProject\Test\Helper\WebHelperDbTrait as DzProjectWebHelperTrait;
use DzTask\Test\Helper\WebHelperDbTrait as DzTaskWebHelperTrait;
use DzUser\Test\Helper\WebHelperDbTrait as DzUserWebHelperTrait;
use SuiviProjet\Test\Helper\WebHelperDbTrait as SuiviProjetWebHelperTrait;

/**
 * Classe helper pour les tests d'acceptance.
 * Fonctions personnalisés pour le WebGuy.
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Helper
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT Licensej
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/_helpers/WebHelper.php
 */
class WebHelper extends \Codeception\Module
{
    use DzProjectWebHelperTrait,
        DzTaskWebHelperTrait,
        DzUserWebHelperTrait,
        SuiviProjetWebHelperTrait {
            SuiviProjetWebHelperTrait::haveAllDefaultsInDatabase insteadof
                DzProjectWebHelperTrait,
                DzTaskWebHelperTrait,
                DzUserWebHelperTrait;
    }
}
