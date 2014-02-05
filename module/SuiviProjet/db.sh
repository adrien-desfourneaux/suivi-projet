#!/bin/sh

# /*!
#     Utilitaire de base de données
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

DBNAME=suiviprojet

# /*!
#     Change de répertoire vers le répertoire du script
#  */
cdscriptpath () {
  if [ -z $SCRIPTPATH ]; then
    SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
    cd $SCRIPTPATH
  fi
}

# /*!
#     Affiche un message de confirmation
#  */
confirm () {
  while true; do
      read -p "Continuer ? " on
      case $on in
          [Oo]* ) break;;
          [Nn]* ) exit;;
          * ) echo "Repondre par oui ou non.";;
      esac
  done
}

# /*!
#     Cré les bases de données de test et de développement du module
#  */
create () { 
  cdscriptpath

  if [ -f data/$DBNAME.sqlite ]; then
    printf "Attention! Lancer ce script va supprimer la base de données de développement $DBNAME ainsi que tout son contenu.\n"
    confirm
    rm data/$DBNAME.sqlite
  fi

  cat data/zfcuser.sqlite.sql \
    data/bjyauthorize.sqlite.sql \
    data/dzuser.sqlite.sql \
    data/dzproject.sqlite.sql \
    data/dztask.sqlite.sql \
    data/suiviprojet.sqlite.sql \
  | sqlite3 data/suiviprojet.sqlite

  chmod g+w data/$DBNAME.sqlite

  if [ ! -f tests/_data/$DBNAME.sqlite ]; then
    sqlite3 tests/_data/$DBNAME.sqlite ""
    chmod g+w tests/_data/$DBNAME.sqlite
  fi
}

# /*!
#     Remplit la base de données de développement du module
#     avec des données de test
#  */
dump () {
  create

  cat data/dzuser.dump.sqlite.sql \
    data/dzproject.dump.sqlite.sql \
    data/dztask.dump.sqlite.sql \
    data/suiviprojet.dump.sqlite.sql \
  | sqlite3 data/suiviprojet.sqlite;
}

# /*!
#     Restaure les permissions des base de données
#     de test et de développement du module
#     ainsi que celle de production
#  */
perm () {
  cdscriptpath

  chmod 770 data
  if [ -f data/$DBNAME.sqlite ]; then chmod 660 data/$DBNAME.sqlite; fi
  if [ -d tests/_data ]; then chmod 770 tests/_data; fi
  if [ -f tests/_data/$DBNAME.sqlite ]; then chmod 660 tests/_data/$DBNAME.sqlite; fi
  if [ -d ../../data ]; then chmod 770 ../../data; fi
  if [ -f ../../data/suivi-projet.sqlite ]; then chmod 660 ../../data/suivi-projet.sqlite; fi
}

# /*!
#     Copie la base de données de développement du module
#     en base de données de production de l'application
#  */
function prod
{
  cdscriptpath;

  if [ -f ../../data/suivi-projet.sqlite ]; then
    printf "Attention! Vous êtes sur le point de supprimer la base de données de production de l'application suivi-projet!\n";
    confirm;

    timestamp=$(date +%s)

    cp ../../data/suivi-projet.sqlite ../../data/suivi-projet_$timestamp.sqlite
    printf "Un copie de sauvegarde de la base de données de production a été faite.\n"
    printf "/data/suivi-projet_$timestamp.sqlite";
  fi

  cp data/suiviprojet.sqlite ../../data/suivi-projet.sqlite
  chmod g+w ../../data/suivi-projet.sqlite
}

# /*!
#     Affiche un message d'aide
#  */
help () {
  printf "Usage: db.sh [action]\n"
  printf "help\taffiche cette aide\n"
  printf "create\tcre la base de donnees\n"
  printf "dump\tcre la base de donnees et y met les données de développement\n"
  printf "perm\trestaure les permissions des bases de données de test, développement et production\n"
  printf "prod\tcopie la bdd de développement du module en bdd de production de l'application\n"
}

if [ $# -eq 0 ]; then help
elif [ "$1" = "help" ]; then help
elif [ "$1" = "create" ]; then create
elif [ "$1" = "dump" ]; then dump
elif [ "$1" = "perm" ]; then perm
elif [ "$1" = "prod" ]; then prod
fi
