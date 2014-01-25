#!/bin/sh

# /*!
#     Create Application database
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/Application/script
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH

function create_db
{
    rm application.sqlite;
    cat application.sqlite.sql | sqlite3 application.sqlite;
}

printf "Warning! Running this script will delete the application database and all its content.\n";

while true; do
    read -p "Continue ? " yn
    case $yn in
        [Yy]* ) create_db; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done
