#!/bin/bash
set -e

# Install composer dependencies if vendor/ doesn't exist
if [ ! -d "/var/www/html/vendor" ]; then
  echo "Installing Composer dependencies..."
  cd /var/www/html
  composer install --no-dev --optimize-autoloader
fi

# Set permissions
chown -R www-data:www-data /var/www/html

# Start Apache in foreground
exec apache2-foreground