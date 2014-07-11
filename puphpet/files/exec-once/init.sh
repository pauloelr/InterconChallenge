#!/bin/bash
echo '[Install] Changing User'
sudo -u vagrant -H /bin/bash - << eof

#Bower Install
echo '[Install] Installing Bower'
sudo npm install -g -s bower

#Homesick Install
echo '[Install] Instaling BashIt'
git clone https://github.com/revans/bash-it.git ~/.bash_it

echo '[Install] Instaling Homesick'
sudo gem install homesick

echo '[Install] Cloning Castle'
yes n | homesick clone pauloelr/Castle

echo '[Install] Changing Branch'
cd ~/.homesick/repos/Castle
git checkout server

echo '[Install] Symlink Castle'
yes a | homesick symlink Castle
source ~/.bashrc

echo '[Install] Enabling Bash-it'
yes y | homesick rc Castle

#Composer Install
echo '[Install] Composer Global Install'
composer global install -n --prefer-source --no-interaction

#Doctrine Install
echo '[Install] Creating and Populating Database'
#/vagrant/vendor/bin/doctrine-module orm:schema-tool:create
#/vagrant/vendor/bin/doctrine-module data-fixture:import

eof
