FROM phpdockerio/php74-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.4-pgsql php7.4-sqlite3 php7.4-xdebug php7.4-gd php7.4-odbc \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN echo "xdebug.mode=develop,debug" >> /etc/php/7.4/fpm/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /etc/php/7.4/fpm/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /etc/php/7.4/fpm/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/log/xdebug.log" >> /etc/php/7.4/fpm/conf.d/xdebug.ini
