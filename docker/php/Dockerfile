FROM php:7.1-cli

# php:7.1 is built on Debian Stretch, which is EOL — point apt at the archive
# mirror or `apt-get update` fails with 404s on the default repos.
RUN sed -i \
        -e 's/deb.debian.org/archive.debian.org/g' \
        -e 's/security.debian.org/archive.debian.org/g' \
        -e '/stretch-updates/d' \
        /etc/apt/sources.list

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        curl \
        unzip \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Composer 2.3+ dropped support for PHP <7.2.5, so pin to the 2.2 LTS line
# which still supports PHP 7.1.
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["tail", "-f", "/dev/null"]
