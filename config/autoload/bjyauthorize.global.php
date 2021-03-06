<?php

return array(
    //'bjyauthorize' => array(
        /**
         * Les règles peuvent être définies ici selon le format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * Les assertions seront chargés via le service manager et doivent implémenter
         * Zend\Acl\Assertion\AssertionInterface.
         * *si vous utilisez les assertions, définissez les via le service manager!*
         */
      /*  'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(*/
                
//                'allow' => array(
                    /**
                     * Autorise les invités 'guest' et utilisateurs 'user'
                     * (également les administrateurs via l'hérirage)
                     * le privilège "wear" sur la ressource "pants"
                     */
                    //array(array('guest', 'user'), 'pants', 'wear')
//                ),

                /**
                 * Ne mixez pas les règles allow/deny si vous utilisez l'héritage de rôle.
                 * Il y a certains bugs étranges.
                 */
                //'deny' => array(
                    // ...
                //),
            /*),
        ),*/

        /**
         * Actuellement, il n'existe que des gardes de contrôleur et de route
         *
         * Pensez à n'activer que l'un ou l'autre des gardes selon vos besoins.
         */
        //'guards' => array(
            /**
             * Si ce garde est spécifié ici (c'est à dire qu'il est activé), il va
             * bloquer l'accès à tous les contrôleurs et actions sauf si spécifié ici.
             * Il est possible d'omettre l' "action" index pour autoriser l'accès à
             * l'intégralité du contrôleur.
             */
//            'BjyAuthorize\Guard\Controller' => array(
//                array('controller' => 'index', 'action' => 'index', 'roles' => array('guest','user')),
//                array('controller' => 'index', 'action' => 'stuff', 'roles' => array('user')),
                
                /**
                 * Vous pouvez également spécifier un tableau d'actions ou un tableau de contrôleurs (ou les deux)
                 * Autorise "guest" et "admin" à accéder aux actions "list" et "manage" sur les contrôleurs "index",
                 * "static" et "console".
                 */
//                array(
//                    'controller' => array('index', 'static', 'console'),
//                    'action' => array('list', 'manage'),
//                    'roles' => array('guest', 'admin')
//                ),
//                array(
//                    'controller' => array('search', 'administration'),
//                    'roles' => array('staffer', 'admin')
//                ),
//                array('controller' => 'zfcuser', 'roles' => array()),
//            ),

            /**
             * Si ce garde est spécifié ici (c'est à dire qu'il est activé),
             * il va bloquer l'accès à toutes les routes sauf si spécifié ici.
             */
//            'BjyAuthorize\Guard\Route' => array(
//                array('route' => 'zfcuser', 'roles' => array('user')),
//                array('route' => 'zfcuser/logout', 'roles' => array('user')),
//                array('route' => 'zfcuser/login', 'roles' => array('guest')),
//                array('route' => 'zfcuser/register', 'roles' => array('guest')),
                // Below is the default index action used by the ZendSkeletonApplication
//                array('route' => 'home', 'roles' => array('guest', 'user')),
//            ),
      /*  ),
    )*/
);