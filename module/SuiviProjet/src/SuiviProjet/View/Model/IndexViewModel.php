<?php

/**
 * Fichier de source du IndexViewModel.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\View\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\View\Model;

use DzViewModule\View\Model\ViewModel;

/**
 * Vue-Modèle pour la page d'accueil de SuiviProjet.
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\View\Model
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
class IndexViewModel extends ViewModel
{
    /**
     * {@inheritdoc}
     */
    protected $assets = array(
        'head' => array(
            'css' => array(
                '/suiviprojet/css/suiviprojet.css',
                '/suiviprojet/vendor/bootstrap/dist/css/bootstrap.min.css',
            ),
        ),
    );
}
