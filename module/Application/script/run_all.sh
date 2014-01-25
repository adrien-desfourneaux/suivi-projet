#!/bin/sh

# /*!
#     Run all scripts in this folder
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = zf2_app/module/Application/script
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH

for r in run_*.sh; do
  if [ $r != 'run_all.sh' ]; then
    printf "\n\n========== $r ==========\n\n"; ./$r;
  fi
done
