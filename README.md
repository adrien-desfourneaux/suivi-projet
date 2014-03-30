Sujet 7 : Suivit de projet
=======================

Ce site permet de définir et de faire évoluer des tâches dans le temps.

Scénarios d'utilisation
-----------------

__Un utilisateur se connecte au site__

* La liste des projets est affichée.
* Une ligne projet contient la désignation, le chef de projet et la période.
* Si la date du jour n'est pas dans la période d'un projet on n'affiche pas le projet
* Authentification en haut à droite pour chef de projet et administrateur

__Un utilisateur visionne les tâches d'un projet__

* On visionne les tâches en sélectionnant un projet sur la page d'accueil.
* La liste des tâches est visualisée dans un calendrier.
* Le calendrier peut-être afficher en semaine (8 semaines dans la page) ou par mois (4 mois)
* Sur chaque tâche un visuel indique son état [ pas commencé, en cours, fait, en retard ]

__Un chef de projet accède à son compte__

* Après authentification, (boucle avec message d'erreur si auth erroné ) accès à la liste des projets suivit.
* Les projets en retards sont marqués.
* Les projets terminés en grisé, (toutes les tâches sont faites)
* Les projets sont affichés par ordre chronologique, seule la date de fin de période compte

__Un chef de projet ajoute un projet__

* En haut de la liste des projets un bouton « add » 
* Cliqué sur « add » ouvre une boîte de dialogue.
* Le formulaire demande Désignation (Texte 200 max), date de début, date de fin (via datepicker)
* Le formulaire à deux boutons Nouveau, Fermer.
* La confirmation ajoute le projet.

__Un chef de projet supprime un projet__

* Devant chaque ligne référençant un projet un icône « effacer »
* Cliqué sur l'icône ouvre une boîte de dialogue de confirmation.
* Confirmer supprime toutes les tâches et le projet. 

__Un chef de projet ajoute une tâche__

* En haut de la page listant les tâches, un icône « ajout tâche » 
* La liste des tâches est présentées comme pour l'utilisateur sous forme de calendrier
* Ajouter une tâche ouvre une boîte de dialogue, contenant un formulaire.
* Une tâche c'est : [ une description, une date début, une date de fin ] (utilisez un datepicker)
* Deux bouton pour le formulaire enregistrer et annuler
* Enregistrer ferme la boîte, retourne au calendrier qui contient maintenant la tâche.
* Le calendrier est centré sur la nouvelle tâche.

__Un chef de projet change l'état d'un tâche__

* Par défaut une tâche est initialisé à : « pas commencé. »
* Sur la représentation de chaque tâche dans le calendrier un menu popup permet de changer l'état.

__Un chef de projet modifie une tâche__

* En cliquant sur une représentation de tâche dans le calendrier une boîte de dialogue s'ouvre.
* La boîte de dialogue est identique à la création, elle est pré-rempli, elle a le même fonctionnement.

__Un chef de projet supprime une tâche__

* Une corbeille sur chaque représentation de tâche permet de la supprimer
* Avant suppression une confirmation est demandée.

__Un chef de projet se déconnecte de son compte__

* En haut à droite déconnexion, il revient à la « home page » public

__L'administrateur accède à son compte__

* L'administrateur s'authentifie au même endroit que le chef de projet.
* Après validation de son authentification, il visualise la liste des chef de projet.
* Chaque ligne de chef de projet donne les infos : [ Nom, Date dernière connexion, Nbr de projet ] 
* La liste est paginée

__L'administrateur ajout un chef de projet__

* En haut de la liste des chef de projet un icône « ajout »
* Ajouter ouvre une boîte de dialogue.
* Le formulaire contient : [ nom, e-mail, un password auto générer ] + deux boutons [ Créer, Annuler ]
* Créer ajoute le chef de projet et lui envoie un e-mail avec ses accès.

__L'administrateur supprime un chef de projet__

* Sur chaque ligne de la liste un icône permet de supprimer le chef de projet
* La suppression doit être confirmée.
* On supprime tous les projets et les tâches associées

__L'administrateur se fait passer pour un chef de projet__

* Sur chaque ligne un icône permet à l'administrateur de s'authentifier comme un chef de projet.
* Après avoir cliquer sur l'icône on arrive sur la « home page » du chef de projet 

__L'administrateur se déconnecte de son compte__

* En haut à droite déconnexion, il revient à la « home page » public

Intégration
============

* Framework Bootstrap 3+ [http://getbootstrap.com/](http://getbootstrap.com/)
* Google Fontes (2 max)
* Site Responsive, portabilité tablette et smartphone
* Microformats (au moins 1 page)
* HTML5 valide W3C.
* CSS3, compatibilité Chrome, Firefox et portabilité IE8
* Notation YSlow : B

