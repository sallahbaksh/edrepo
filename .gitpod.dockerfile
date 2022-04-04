FROM gitpod/workspace-mysql

### PHP ###
USER root
ENV PHP_VERSION=7.2
RUN add-apt-repository -y ppa:ondrej/php \
    && install-packages \
      php${PHP_VERSION}-cli php${PHP_VERSION}-gd \
      php${PHP_VERSION}-curl php${PHP_VERSION}-xml php${PHP_VERSION}-zip php${PHP_VERSION}-bcmath \
      php${PHP_VERSION}-gmp php${PHP_VERSION}-mysqlnd php${PHP_VERSION}-mbstring php${PHP_VERSION}-intl \
      php${PHP_VERSION}-redis php${PHP_VERSION}-maxminddb php${PHP_VERSION}-xdebug \
      mariadb-client \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
