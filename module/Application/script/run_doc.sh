#!/bin/sh

# /*!
#     Run documentation generation for the Suivi-Projet Application module.
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = "zf2_app/module/Application/script"
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/phpdoc.php run -d . -t doc
