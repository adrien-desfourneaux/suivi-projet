<?php

/**
 * Test d'acceptation ShowActiveProjectsToVisitor.
 * Un utilisateur se connecte au site. La liste des projets est affichée.
 * Une ligne projet contient la désignation, le chef de projet et la période.
 * Si la date du jour n'est pas dans la période d'un projets on n'affiche pas le projet.
 *
 * PHP Version 5.3.3
 *
 * @category   Test
 * @package    Application
 * @subpackage Acceptance
 * @author     Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/Application/tests/acceptance/ShowActiveProjectsToVisitorCept.php
 */

$I = new WebGuy($scenario);
$I->wantTo('Voir la liste des projets actifs');

$time          = new \DateTime();
$twoDaysBefore = strtotime(date('y-m-d', $time->modify('-2 days')->getTimestamp()));

$oneDayBefore = new \DateTime();
$oneDayBefore  = strtotime(date('y-m-d', $time->modify('-1 days')->getTimestamp()));

$time          = new \DateTime();
$today         = strtotime(date('y-m-d', $time->getTimestamp()));

$time          = new \DateTime();
$oneDayAfter   = strtotime(date('y-m-d', $time->modify('+1 day')->getTimestamp()));

$time          = new \DateTime();
$twoDaysAfter  = strtotime(date('y-m-d', $time->modify('+2 days')->getTimestamp()));

$I->haveInDatabase(
    'user', array(
        'user_id'      => '1',
        'display_name' => 'Super chef de projet',
        'password'     => 'cestmoileplusfort'
    )
);

$I->haveInDatabase(
    'user', array(
        'user_id'      => '2',
        'display_name' => 'Jolie développeuse',
        'password'     => 'jefaisdemonmieux'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '1',
        'display_name' => 'Projet terminé',
        'begin_date'   => $twoDaysBefore,
        'end_date'     => $oneDayBefore,
        'user_id'      => '1'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '2',
        'display_name' => "Projet qui se termine aujourd'hui",
        'begin_date'   => $oneDayBefore,
        'end_date'     => $today,
        'user_id'      => '1'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '3',
        'display_name' => "Projet qui commence aujourd'hui",
        'begin_date'   => $today,
        'end_date'     => $oneDayAfter,
        'user_id'      => '1'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '4',
        'display_name' => 'Projet actif num. 1',
        'begin_date'   => $twoDaysBefore,
        'end_date'     => $twoDaysAfter,
        'user_id'      => '1'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '5',
        'display_name' => 'Projet actif num. 2',
        'begin_date'   => $oneDayBefore,
        'end_date'     => $oneDayAfter,
        'user_id'      => '1'
    )
);

$I->haveInDatabase(
    'project', array(
        'project_id'   => '6',
        'display_name' => "Projet qui n'a pas encore commencé",
        'begin_date'   => $oneDayAfter,
        'end_date'     => $twoDaysAfter,
        'user_id'      => '1'
    )
);

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
