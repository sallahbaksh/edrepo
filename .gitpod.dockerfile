FROM gitpod/workspace-mysql

# Install and configure php and php-fpm as specified in starter.ini
RUN sudo bash -c ". /tmp/php.sh" && rm /tmp/php.sh
