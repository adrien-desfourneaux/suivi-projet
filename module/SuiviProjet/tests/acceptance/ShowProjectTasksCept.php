<?php

/**
 * Test d'acceptation ShowProjectTasks.
 * Un utilisateur visionne les tâches d'un projet.
 * On visionne les tâches en sélectionnant un projet sur la page d'accueil.
 * La liste des tâches est visualisée dans un calendrier.
 * Le calendrier peut être affiché en semaine (8 semaines dans la page) ou par mois (4 mois).
 * Sur chaque tâche, un visuel indique son état [ pas commencé, en cours, fait, en retard ].
 *
 * PHP Version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/acceptance/ShowProjectTasks.php
 */

$I = new WebGuy($scenario);
$I->wantTo("Voir les tâches d'un projet");

// Utiliser tous les dump par défaut
$I->haveAllDefaultsInDatabase();

// Créer les utilisateurs
// Créer les roles
// Créer les liens roles utilisateurs
// Créer les projets
// Créer les états de tâches
// Créer les taches

$I->amOnPage('/');

$I->see('Projets');

$I->see('Désignation');
$I->see('Chef de projet');
$I->see('Période');

$I->see('Super chef de projet');
$I->dontSee('Jolie développeuse');

$I->dontSee('Projet terminé');
$I->dontSee("Projet qui n'a pas encore commencé");

$I->see("Projet qui se termine aujourd'hui");
$I->see(strftime("%d/%m/%Y", $oneDayBefore));
$I->see(strftime("%d/%m/%Y", $today));

$I->see("Projet qui commence aujourd'hui");
$I->see(strftime("%d/%m/%Y", $today));
$I->see(strftime("%d/%m/%Y", $oneDayAfter));

$I->see('Projet actif num. 1');
$I->see(strftime("%d/%m/%Y", $twoDaysBefore));
$I->see(strftime("%d/%m/%Y", $twoDaysAfter));

$I->see('Projet actif num. 2');
$I->see(strftime("%d/%m/%Y", $oneDayBefore));
$I->see(strftime("%d/%m/%Y", $oneDayAfter));
