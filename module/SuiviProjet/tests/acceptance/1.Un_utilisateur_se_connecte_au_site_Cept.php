<?php

/**
 * Test d'acceptation du cas d'utilisation "Un utilisateur se connecte au site".
 * Un utilisateur se connecte au site. La liste des projets est affichée.
 * Une ligne projet contient la désignation, le chef de projet et la période.
 * Si la date du jour n'est pas dans la période d'un projets on n'affiche pas le projet.
 *
 * PHP Version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/acceptance/1.Un_utilisateur_se_connecte_au_site_Cept.php
 */

$I = new WebGuy($scenario);

$I->am("Visiteur");
$I->wantTo("se connecter au site");
$I->lookForwardTo("voir la liste des projets et le formulaire d'authentification");

$I->haveAllDefaultsInDatabase();

$I->amOnPage('/');

$I->see('Liste des projets');

$I->see('Désignation');
$I->see('Chef de projet');
$I->see('Période');

$I->dontSee("Projet non débuté");
$I->see("Projet qui débute aujourd'hui");
$I->see("Projet actif 1");
$I->see("Projet actif 2");
$I->see("Projet qui se termine aujourd'hui");
$I->dontSee("Projet terminé");

$I->see("John Doe (Chef de projet)");
$I->dontSee("Jane Doe (Admin)");

$I->see("Authentification");