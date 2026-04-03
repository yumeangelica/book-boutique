#!/bin/bash
set -e

# Install composer dependencies if vendor/ doesn't exist
if [ ! -d "/var/www/html/vendor" ]; then
  echo "Installing Composer dependencies..."
  cd /var/www/html
  composer install --no-dev --optimize-autoloader
fi

# Set permissions only for writable runtime directories
mkdir -p /var/www/html/vendor
chown -R www-data:www-data /var/www/html/vendor || true

# Start Apache in foreground
exec apache2-foreground