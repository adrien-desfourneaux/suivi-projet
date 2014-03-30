<?php

/**
 * Test d'acceptation "Un chef de projet accède à son compte".
 * Un chef de projet acède à son compte. Après authentification (boucle avec message d'erreur si auth erroné)
 * accès à la liste des projets suivis. Les projets en retard sont marqués. Les projets terminés en grisés
 * (toutes les tâches sont faîtes). Les projets sont affichés par ordre chronologique, seule la date de fin
 * de période compte.
 *
 * PHP Version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/acceptance/3.Un_chef_de_projet_accede_a_son_compte_Cept.php
 */

$I = new WebGuy($scenario);

$I->am("Chef de projet");
$I->wantTo("acceder a mon compte");
$I->lookForwardTo("voir l'etat de mes projets");

$I->haveAllDefaultsInDatabase();

// Authentification erronée
$I->amOnPage('/');
$I->fillField("input[name='identity']", 'une@erreur.com');
$I->fillField("input[name='credential']", 'erreur');
$I->click('Authentification');
$I->canSeeCurrentUrlEquals('/');
$I->canSee('Erreur auth erroné');

// Autentification réussie
$I->fillField("input[name='identity']", 'john@doe.com');
$I->fillField("input[name='credential']", 'johndoe');
$I->click('Authentification');

// Un chef de projet accède à son compte
$I->canSeeInCurrentUrl('/user/account');

// Les projets en retard sont marqués

// Un chef de projet accède à son compte
//$I->seeInCurrentUrl('/user/account');
