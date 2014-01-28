#!/bin/sh

# /*!
#     Cré la base de données SuiviProjet.
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/SuiviProjet/data
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH

function create_db
{
    rm -f suivi-projet.sqlite;
    cat suivi-projet.sqlite.sql | sqlite3 suivi-projet.sqlite;
}

printf "Attention! Lancer ce script va supprimer la base de données suivi-projet et tout son contenu.\n";

while true; do
    read -p "Continuer ? " on
    case $on in
        [Oo]* ) create_db; break;;
        [Nn]* ) exit;;
        * ) echo "Répondre par oui ou non.";;
    esac
done
