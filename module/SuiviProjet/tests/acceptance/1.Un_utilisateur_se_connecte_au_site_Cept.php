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

$I->haveAllSuiviProjetDefaultsInDatabase();

$I->amOnPage('/');

$I->canSee('Liste des projets');

$I->canSee('Désignation');
$I->canSee('Chef de projet');
$I->canSee('Période');

$I->cantSee("Projet non débuté");
$I->canSee("Projet qui débute aujourd'hui");
$I->canSee("Projet actif 1");
$I->canSee("Projet actif 2");
$I->canSee("Projet qui se termine aujourd'hui");
$I->cantSee("Projet terminé");

$I->canSee("John Doe (Chef de projet)");
$I->cantSee("Jane Doe (Admin)");

$I->canSee("Authentification");
