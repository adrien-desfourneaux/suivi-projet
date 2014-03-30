#!/bin/bash

# Delete autoload_classmaps
find . -type f -name autoload_classmap.php -exec rm {} \;

# Rename namespaces inside files
find . -type f | xargs grep -E '\\?Dz(Base|Project|Task|User)[^Module]\\?' -sl | xargs sed -E -i "" 's/(\\?)Dz(Base|Project|Task|User)([^Module])(\\?)/\1Dz\2Module\3\4/g'

# Rename paths inside files
find . -type f | xargs grep -E '\/?Dz\(Base|Project|Task|User\)[^Module]\/?' -sl | xargs sed  -E -i "" 's/(\/?)Dz(Base|Project|Task|User)([^Module])(\/?)/\1Dz\2Module\3\4/g'

# Rename classes folder names
find . -type d -name 'DzBase' -exec mv {} {}Module \;
find . -type d -name 'DzProject' -exec mv {} {}Module \;
find . -type d -name 'DzTask' -exec mv {} {}Module \;
find . -type d -name 'DzUser' -exec mv {} {}Module \;

# Rename view folders names
find . -type d -name 'dz-base' -exec mv {} {}-module \;
find . -type d -name 'dz-project' -exec mv {} {}-module \;
find . -type d -name 'dz-task' -exec mv {} {}-module \;
find . -type d -name 'dz-user' -exec mv {} {}-module \;

# Rename view paths inside files
find . -type f | xargs grep -E '\/?dz-(base|project|task|user)[^-module]\/?' -sl | xargs sed -E -i "" 's/(\/?)dz-(base|project|task|user)([^-module])(\/?)/\1dz-\2-module\3\4/g'

# Rename symlinks (not working)
find . -type l -lname "*DzBase/*" -or -lname "*DzProject/*" -or -lname "*DzTask/*" -or -lname "*DzUser/*" -exec bash -c 'rm "{}" && ln -s `file "{}" | awk "{print $6}" | sed -e "s/DzBase\([^Module]\)/DzBaseModule\1/g" -e "s/DzProject\([^Module]\)/DzProjectModule\1/g" -e "s/DzTask\([^Module]\)/DzTaskModule\1/g" -e "s/DzUser\([^Module]\)/DzTaskModule\1/g"` "{}"' \;

# Recreate autoload_classmaps
find . -type f -name qa.sh -exec ./{} loader classmap \;

# Redump databases & perm
find . -type f -name db.sh -exec ./{} dump \+ ./{} perm \;
