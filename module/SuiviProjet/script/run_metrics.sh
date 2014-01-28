#!/bin/sh

# /*!
#     Lance la génération des métriques pour le module SuiviProjet.
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = "zf2_app/module/SuiviProjet/script"
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/pdepend --summary-xml="metrics/summary.xml" \
                         --jdepend-chart="metrics/jdepend.svg" \
                         --overview-pyramid="metrics/pyramid.svg" \
                         .
../../vendor/bin/phploc --progress . > metrics/stats.txt
