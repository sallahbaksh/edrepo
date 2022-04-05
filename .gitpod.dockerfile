# FROM php:5.6-cli

FROM mysql:5.7-debian

RUN apt-get update && apt-get -y upgrade \
    && apt-get install -y wget pkg-config build-essential autoconf bison re2c libxml2-dev libsqlite3-dev

RUN wget https://www.php.net/distributions/php-5.6.40.tar.gz \
    && tar -xzf php-5.6.40.tar.gz \
    && cd php-5.6.40 \
    && ./configure \
    && make \
    && make install
