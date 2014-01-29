#!/bin/sh

# /*!
#     Lance la génération de la documentation pour le module SuiviProjet
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = "zf2_app/module/SuiviProjet/script"
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/phpdoc.php run -d . -t doc
