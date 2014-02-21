<?php

/**
 * Fichier de source pour le CurrentUrl ViewHelper
 * Renvoi l'url courante
 *
 * PHP version 5.3.3
 *
 * @category Source
 * @package  SuiviProjet\View\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/View/Helper/CurrentUrl.php
 */

namespace SuiviProjet\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

/**
 * Classe d'aide de vue CurrentUrl
 * Renvoi l'url courante
 *
 * @category Source
 * @package  SuiviProjet\View\Helper
 * @author   Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/src/SuiviProjet/View/Helper/CurrentUrl.php
 */
class CurrentUrl extends AbstractHelper
{

    /**
     * Requête courante
     * @var Request
     */
    protected $request;

    /**
     * Constructeur de l'aide de vue CurrentUrl
     *
     * @param Request $request Requête courante
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Méthode appelée lorsqu'un script tente d'appeler cet objet comme une fonction.
     *
     * @return string Url courante
     */
    public function __invoke()
    {
        if ($this->request) {
            $url = $this->request->getUriString();
            return $url;
        }
    }
}
