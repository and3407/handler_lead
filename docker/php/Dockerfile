FROM php:8.1-fpm

WORKDIR /var/www/html/handlerlead

RUN apt-get update \
  && apt-get install -y \
     build-essential \
     libzip-dev \
     libpng-dev \
     libjpeg62-turbo-dev \
     libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
     libfreetype6 \
     libfreetype6-dev \
     locales \
     zip \
     jpegoptim optipng pngquant gifsicle \
     vim \
     unzip \
     git \
     curl \
     supervisor

RUN docker-php-ext-install sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/log/supervisor

# Copy local supervisord.conf to the conf.d directory
COPY --chown=root:root /docker/php/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]




