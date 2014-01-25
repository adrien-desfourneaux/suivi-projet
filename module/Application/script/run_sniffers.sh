#!/bin/sh

# /*!
#     Run all sniffers for the Suivi-Projet Application module
#     @author Adrien Desfourneaux <adrien.desfourneaux@gmail.com>
#  */

# SCRIPTPATH = "zf2_app/module/Application/script"
SCRIPTPATH=$( cd "$(dirname "$0")" ; pwd -P )
cd $SCRIPTPATH/..
../../vendor/bin/phpcs --standard="./phpcs.xml" --ignore="/doc/" --extensions="php,phtml" .
../../vendor/bin/phpmd . text ./phpmd.xml --exclude "doc,tests*Guy.php" --suffixes "php,phtml"
../../vendor/bin/phpcpd --progress .

# Finds docblocks mistakes
Category="(\<Config\>|\<Autoload\>|\<Source\>|\<Spec\>|\<Test\>)$"
Package="\<Application(/.*|\>)"
Author="Adrien Desfourneaux <adrien\.desfourneaux@gmail\.com>$"
License="\shttp://opensource.org/licenses/MIT The MIT License$"
Link="\<https://github.com/adrien-desfourneaux/suivi-projet/tree/master/module/Application/.+"
exclude=".*tests.*Guy.php$"

find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@category\s+${Category}" | awk '{print "Wrong or no package name in "$1}'
find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@package\s+${Package}" | awk '{print "Wrong or no package name in "$1}'
find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@author\s+${Author}" | awk '{print "Wrong or no author in "$1}'
find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@license\s+${License}" | awk '{print "Wrong or no license in "$1}'
find . \( -name "*.php" -o -name "*.phtml" \) -and -not -regex "$exclude" | xargs grep -E -sL "@link\s+${Link}" | awk '{print "Wrong or no link in "$1}'
