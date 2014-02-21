#!/bin/bash

# /*!
#     Script d'assurance qualité (Quality Assurance)
#     Vérifie la qualité du code
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

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
#     Lance les tests de spécification
#  */
runspec () {
    cdscriptpath
    ../../vendor/bin/phpspec run
}

# /*!
#     Lance les tests d'acceptation
#  */
runcept () {
    cdscriptpath
    ../../vendor/bin/codecept run --steps
}

# /*!
#     Lance le code sniffer
#  */
runcodesniffer () {
    cdscriptpath
    ../../vendor/bin/phpcs --standard="phpcs.xml" --ignore="/doc/" --extensions="php,phtml" .
}

# /*!
#     Vérifie la présence d'indentation
#     avec des caractères tabs
#  */ 
checktabindent () {
    exclude="^\./(\.git/|doc/|.*_log/|.*\.DS_Store$|.*\.png$|.*\.jar$|.*\.sqlite$).*"

    if uname | grep "Linux" > /dev/null; then
        find . -regextype posix-extended -not -regex "$exclude" | xargs grep $'^\t' -sl | awk '{print "Tab indent in "$1}'
    elif uname | grep "Darwin" > /dev/null; then
        find -E . -not -regex "$exclude" | xargs grep "^\t" -sl | awk '{print "Tab indent in "$1}'
    else
        echo "Impossible de détecter les indentations avec caractères tab\n" 1>&2
        return 1
    fi
}

# /*!
#     Lance le mess detector
#  */
runmessdetector () {
    cdscriptpath
    ../../vendor/bin/phpmd . text phpmd.xml --exclude "doc,tests*Guy.php" --suffixes "php,phtml"
}

# /*!
#     Lance le copy-paste detector
#  */
runcpdetector () {
    cdscriptpath
    ../../vendor/bin/phpcpd --progress .
}

# /*!
#     Génère les statistiques du module
#     Deprécié
#  */
genstats () {
    cdscriptpath
    mkdir -p metrics
    ../../vendor/bin/phploc --progress . > metrics/stats.txt
}

# /*!
#     Affiche les statistiques du module
#  */
showstats () {
    cdscriptpath
    mkdir -p metrics
    ../../vendor/bin/phploc --progress . > metrics/stats.txt
}

# /*!
#     Génère les métriques du module
#  */
gendepend () {
    cdscriptpath
    mkdir -p metrics
    ../../vendor/bin/pdepend --summary-xml="metrics/summary.xml" \
        --jdepend-chart="metrics/jdepend.svg" \
        --overview-pyramid="metrics/pyramid.svg" \
        .
}

# /*!
#     Génére la documentation du module
#  */
gendoc () {
    cdscriptpath
    mkdir -p doc
    ../../vendor/bin/phpdoc.php run -d . -t doc
}

# /*!
#     Vérifie la documentation (docblocks) du module
#  */
checkdoc () {
    cdscriptpath

    Category="(\<Config\>|\<Autoload\>|\<Source\>|\<Spec\>|\<Test\>)$"
    Package="\<SuiviProjet(/.*|\>)"
    Author="Adrien Desfourneaux <adrien.desfourneaux@gmail\.com>$"
    License="\shttp://opensource.org/licenses/MIT The MIT License$"
    Link="\<https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/SuiviProjet/.+"
    exclude=".*tests.*Guy.php$"

    find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@category\s+${Category}" | awk '{print "Wrong or no category in "$1}'
    find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@package\s+${Package}" | awk '{print "Wrong or no package name in "$1}'
    find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@author\s+${Author}" | awk '{print "Wrong or no author in "$1}'
    find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@license\s+${License}" | awk '{print "Wrong or no license in "$1}'
    find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@link\s+${Link}" | awk '{print "Wrong or no link in "$1}'
}

# /*!
#     Génère le classmap pour l'autoloader
#  */
genclassmap () {
    cdscriptpath

    ../../vendor/bin/classmap_generator.php .
}

# /*!
#     Lance toutes les commandes
#  */
runall () {
    # test
    runspec
    runcept

    # code check
    runcodesniffer
    checktabindent
    runmessdetector
    runcpdetector

    # code stats
    showstats

    # code depend
    gendepend

    # doc
    gendoc
    checkdoc

    # loader
    genclassmap
}

# /*!
#     Affiche l'aide
#  */
help () {
    printf "Usage: qa.sh [command]\n"
    printf "help\t\tAffiche cette aide\n"
    printf "help [command]\tAffiche l'aide de la commande\n"
    printf "test\t\tGestion des tests du module\n"
    printf "code\t\tGestion du code source\n"
    printf "doc\t\tGestion de la documentation du module\n"
    printf "loader\t\tGestion du loader du module\n"
    printf "all\t\tLance toutes les commandes\n"
    printf "\nAffiche cette aide si aucune action n'est spécifiée\n"
}

# /*!
#     Affiche l'aide de la gestion des test
#  */
helptest () {
    printf "Usage: qa.sh test [arg]\n"
    printf "spec\tLance les tests de spécification\n"
    printf "cept\tLance les tests d'acceptation\n"
}

# /*!
#      Affiche l'aide de la gestion du code
#  */
helpcode () {
    printf "Usage: qa.sh code [command]\n"
    printf "check\tVéfifie la syntaxe du code\n"
    printf "stats\tAffiche des statistiques sur le code\n"
    printf "depend\tGénère les diagrammes de dépendances de code\n"
    printf "\nLance tous les arguments si aucun n'est spécifié\n"
}

# /*!
#     Affiche l'aide de la gestion de la documentation
#  */
helpdoc () {
    printf "Usage: qa.sh doc [action]\n"
    printf "check\tvérifie les blocs de documentation de code\n"
    printf "gen\tGénère la documentation du module\n"
    printf "\nLance toutes les actions si aucune n'est spécifiée\n"
}

# /*!
#     Affiche l'aide de la gestion du loader du module
#  */
helploader () {
    printf "Usage: qa.sh loader [arg]\n"
    printf "classmap\tGénère le classmap pour l'autoload\n"
    printf "\nLance toutes les arguments si aucun n'est spécifié\n"
} 

# no argument
if [ $# -eq 0 ]; then help

# help
elif [ $1 = 'help' ]; then
    if [ $# -eq 1 ]; then help
    elif [ $2 = 'test' ]; then helptest
    elif [ $2 = 'code' ]; then helpcode
    elif [ $2 = 'doc' ]; then helpdoc
    elif [ $2 = 'loader' ]; then helploader
    else help
    fi

# test
elif [ $1 = 'test' ]; then
    if [ $# -eq 1 ]; then runspec; runcept
    elif [ $2 = 'spec' ]; then runspec
    elif [ $2 = 'cept' ]; then runcept
    else helptest
    fi

# code
elif [ $1 = 'code' ]; then
    if [ $# -eq 1 ]; then
        runcodesniffer
        checktabindent
        runmessdetector
        runcpdetector
        showstats
        gendepend
    elif [ $2 = 'check' ]; then
        runcodesniffer
        checktabindent
        runmessdetector
        runcpdetector
    elif [ $2 = 'stats' ]; then showstats
    elif [ $2 = 'depend' ]; then gendepend
    else helpcode
    fi

# doc
elif [ $1 = 'doc' ]; then
    if [ $# -eq 1 ]; then checkdoc; gendoc
    elif [ $2 = 'check' ]; then checkdoc
    elif [ $2 = 'gen' ]; then gendoc
    else helpdoc
    fi

# loader
elif [ $1 = 'loader' ]; then
    if [ $# -eq 1 ]; then genclassmap
    elif [ $2 = 'classmap' ]; then genclassmap
    else helpdoc
    fi

# all
elif [ $1 = 'all' ]; then runall;

# help
else help;

fi
