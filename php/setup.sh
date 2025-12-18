#!/bin/bash

# Update packages
sudo apt update

# Install PHP 8.3 and required build tools
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-dev php8.3-common \
    php8.3-curl php8.3-mbstring php8.3-xml php8.3-zip \
    gcc make autoconf

# Install Swoole via PECL (latest version compatible with PHP 8.3)
sudo pecl install swoole

# Enable the extension
echo "extension=swoole.so" | sudo tee /etc/php/8.3/mods-available/swoole.ini
sudo phpenmod swoole

# Verify installation
php -v
php -m | grep swoole
php --ri swoole
