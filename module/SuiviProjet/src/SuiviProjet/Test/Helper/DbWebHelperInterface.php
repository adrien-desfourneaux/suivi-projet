<?php

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * PHP version 5.3.0
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */

namespace SuiviProjet\Test\Helper;

/**
 * Interface pour WebHelper qui utilise les méthodes de Db
 *
 * @category Source
 * @package  SuiviProjet\Test\Helper
 * @author   Adrien Desfourneaux (aka Dieze) <dieze51@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link     https://github.com/adrien-desfourneaux/suivi-projet
 */
interface DbWebHelperInterface
{
    /**
     * Définit les relations entre les projets et les utilisateurs
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultProjectsUserRelationsInDatabase();

    /**
     * Définit les relations entre les projets et les tâches
     * dans la base de données
     *
     * @return void
     */
    public function haveDefaultTasksProjectRelationsInDatabase();

    /**
     * Définit tout par défaut
     * dans la base de données
     *
     * @return void
     */
    public function haveAllSuiviProjetDefaultsInDatabase();
}
