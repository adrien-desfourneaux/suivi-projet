#!/bin/sh

mkdir -p /usr/share/puppet/modules
cd /usr/share/puppet/modules

mkdir -p npm-provider/lib/puppet/provider/package
cd npm-provider/lib/puppet/provider/package

if [ ! -f npm.rb ]; then
	wget https://raw.github.com/puppetlabs/puppetlabs-nodejs/master/lib/puppet/provider/package/npm.rb
fi