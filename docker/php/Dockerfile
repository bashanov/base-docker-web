FROM php:7.3-fpm

# build deps:
#   libzip-dev - zip
#   libssh2-1-dev - ssh2

# runtime deps:
#   libzip4 - zip
#   libssh2-1 - ssh2
#   msmtp - replacement of sendmail for php (mail() function)

# Also installed
# git
# composer

RUN apt-get update; \
    buildDeps=" \
            libssh2-1-dev \
            libzip-dev \
        "; \
    runtimeDeps=" \
            libssh2-1 \
            libzip4 \
            msmtp \
        "; \
	DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends $buildDeps $runtimeDeps autoconf automake libtool make g++ unzip git apt-utils; \
	rm -r /var/lib/apt/lists/*; \
	ln -s /usr/bin/msmtp /usr/sbin/sendmail; \
	apt-get install -y libssh2-1-dev libssh2-1; \
	pecl install ssh2-alpha; \
	docker-php-ext-install mysqli pdo_mysql zip; \
	docker-php-ext-enable ssh2; \
	apt-get purge -y --auto-remove $buildDeps;

ENV COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_HOME=/tmp/.composer RUN_USER=root

# See https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md
RUN set -ex; \
     curl -fso composer-setup.php 'https://getcomposer.org/installer'; \
     curl -fs 'https://composer.github.io/installer.sha384sum' | sha384sum -c -; \
     php composer-setup.php --quiet --no-ansi --install-dir=/usr/local/bin --filename=composer; \
     rm composer-setup.php;

WORKDIR /var/www

CMD ["php-fpm"]
