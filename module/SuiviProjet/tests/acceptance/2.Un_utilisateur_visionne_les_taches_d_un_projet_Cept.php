<?php

/**
 * Test d'acceptation "Un utilisateur visionne les tâches d'un projet".
 * Un utilisateur visionne les tâches d'un projet. On visionne les tâches en sélectionnant
 * un projet sur la page d'accueil. La liste des tâches est visualisée dans un calendrier.
 * Le calendrier peut-être affiché en semaine (8 semaines dans la page) ou par mois (4 mois).
 * Sur chaque tâche un visuel indique son état [ pas commencé, en cours, fait, en retard ].
 *
 * PHP Version 5.3.3
 *
 * @category   Test
 * @package    SuiviProjet
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/tests/acceptance/2.Un_utilisateur_visionne_les_taches_d_un_projet_Cept.php
 */

$I = new WebGuy($scenario);

$I->am("Visiteur");
$I->wantTo("visionner les taches d'un projet");
$I->lookForwardTo("voir l'état des tache du projet");

$I->haveAllDefaultsInDatabase();

$I->amOnPage('/');
$I->click('Projet actif 1');

$I->canSeeInCurrentUrl('/task/list/3');

// TODO: la liste des tâches est visualisée dans un calendrier

// TODO: le calendrier peut-être affiché en semaines
// (8 semaines dans la page) ou par mois (4 mois)
