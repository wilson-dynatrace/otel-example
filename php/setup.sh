#!/bin/bash

# Install latest PHP 8.4 from Ondřej Surý PPA
sudo apt install software-properties-common python3-launchpadlib python3-apt -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php8.4 php8.4-cli php8.4-dev php8.4-common ...

# Install latest Swoole via PECL
sudo pecl install swoole  # Installs the latest (6.x+)
# or for OpenSwoole: sudo pecl install openswoole

# Enable the extension
echo "extension=swoole.so" | sudo tee /etc/php/8.3/mods-available/swoole.ini
sudo phpenmod swoole

# Verify installation
php -v
php -m | grep swoole
php --ri swoole
