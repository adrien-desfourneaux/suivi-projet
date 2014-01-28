#!/bin/sh

# /*!
#     Lance tous les tests pour le module SuiviProjet.
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = "zf2_app/module/SuiviProjet/script"
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..

if [ $# -eq 0 ]; then
    ../../vendor/bin/phpspec run
    ../../vendor/bin/codecept run
fi;

if [ "$1" = "spec" ]; then ../../vendor/bin/phpspec run; fi
if [ "$1" = "cept" ]; then ../../vendor/bin/codecept run; fi
