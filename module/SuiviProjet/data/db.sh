#!/bin/sh

# /*!
#     Utilitaire pour la base de données de développement du module SuiviProjet
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

function cdscriptpath
{
	# SCRIPTPATH = zf2_app/module/SuiviProjet/data
	SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
	cd $SCRIPTPATH
}

function confirm
{
	while true; do
	    read -p "Continuer ? " on
	    case $on in
	        [Oo]* ) break;;
	        [Nn]* ) exit;;
	        * ) echo "Repondre par oui ou non.";;
	    esac
	done
}

function create
{	
	cdscriptpath;

	if [ -f suiviprojet.sqlite ]; then
		printf "Attention! Lancer ce script va supprimer la base de données de développement de SuiviProjet ainsi que tout son contenu.\n";
		confirm;
    	
    	rm suiviprojet.sqlite;
    fi

    cat zfcuser.sqlite.sql \
    	bjyauthorize.sqlite.sql \
    	dzuser.sqlite.sql \
    	dzproject.sqlite.sql \
    	dztask.sqlite.sql \
    	suiviprojet.sqlite.sql \
    | sqlite3 suiviprojet.sqlite

    chmod g+w suiviprojet.sqlite
}

function dump
{
	create;

	cdscriptpath;

	cat dzuser.dump.sqlite.sql \
		dzproject.dump.sqlite.sql \
		dztask.dump.sqlite.sql \
		suiviprojet.dump.sqlite.sql \
	| sqlite3 suiviprojet.sqlite;
}

function prod
{
	cdscriptpath;

	if [ -f ../../../data/suivi-projet.sqlite ]; then
		printf "Attention! Vous êtes sur le point de supprimer la base de données de production de l'application suivi-projet!\n";
		confirm;

		timestamp=$(date +%s)

		cp ../../../data/suivi-projet.sqlite ../../../data/suivi-projet_$timestamp.sqlite
		printf "Un copie de sauvegarde de la base de données de production a été faite.\n"
		printf "/data/suivi-projet_$timestamp.sqlite";
	fi

	cp suiviprojet.sqlite ../../../data/suivi-projet.sqlite
	chmod g+w ../../../data/suivi-projet.sqlite
}

function help
{
	printf "Usage: db.sh [action]\n";
	printf "help\taffiche cette aide\n"
	printf "create\tcre la base de donnees\n";
	printf "dump\tcre la base de donnees et y met les données de développement\n";
	printf "prod\tenvoie la base de données en production\n";
}

if [ $# -eq 0 ]; then help; fi
if [ "$1" = "help" ]; then help; fi
if [ "$1" = "create" ]; then create; fi
if [ "$1" = "dump" ]; then dump; fi
if [ "$1" = "prod" ]; then prod; fi