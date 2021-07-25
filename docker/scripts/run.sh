#!/bin/bash

# Permissions
chmod -R o-xw,o+r /var/www
chmod -R u+rw /var/www/webroot/engine/cache
chmod -R u+rw /var/www/webroot/engine/log
chmod +x /var
chmod +x /var/www/
chmod +x /var/www/html/
chmod +x /var/www/html/webroot/
chmod +x /var/www/html/engine/run-tests.sh

# Start up services
#/usr/sbin/nginx
#service nginx start
#memcached -d -u memcache
#service cron start
tail -f /dev/null