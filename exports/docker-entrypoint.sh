#!/bin/sh

/bin/chown -R www-data:www-data /var/www/html/storage
/usr/local/bin/php /var/www/html/artisan lighthouse:clear-cache # has to be cleared before optimize
/usr/local/bin/php /var/www/html/artisan optimize
/usr/local/bin/php /var/www/html/artisan lighthouse:clear-cache # has to be cleared again after optimize
/usr/local/bin/php /var/www/html/artisan migrate --force

exec "$@"
