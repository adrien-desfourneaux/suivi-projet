#!/bin/sh

# /*!
#     Cré la base de données de développement pour le module SuiviProjet
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/SuiviProjet/data
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH

function create_db
{
    rm -f suiviprojet.sqlite;
    cat suiviprojet.sqlite.sql | sqlite3 suiviprojet.sqlite;
}

printf "Attention! Lancer ce script va supprimer la base de données de développement de SuiviProjet ainsi que tout son contenu.\n";

while true; do
    read -p "Continuer ? " on
    case $on in
        [Oo]* ) create_db; break;;
        [Nn]* ) exit;;
        * ) echo "Répondre par oui ou non.";;
    esac
done
