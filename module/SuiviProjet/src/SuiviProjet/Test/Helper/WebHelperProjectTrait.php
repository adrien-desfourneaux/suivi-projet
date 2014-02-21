<?php

/**
 * Trait pour WebHelper.
 * Contient des méthodes helpers pour tout ce qui touche aux projets.
 * 
 * PHP version 5.4.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/WebHelperProjectTrait.php
 */

namespace SuiviProjet\Test\Helper;

/**
 * Trait pour WebHelper.
 * Contient des méthodes helpers pour tout ce qui touche aux projets.
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/Test/Helper/WebHelperProjectTrait.php
 */
trait WebHelperProjectTrait
{
	/**
	 * Vérifie que le projet qui possède la désignation passée
	 * en paramètre est marqué
	 *
	 * @param string $projectDisplayName Nom du projet qu'il faut vérifier
	 *
	 * @return 
	 */
	public function seeProjectMarked($projectDisplayName) {
		$browser = $this->getModule('PhpBrowser');
		$browser->grabTextFrom('')
	}
}