FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid
ARG group
ARG gid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install pecl redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

###########################3

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system group and user
RUN groupadd --gid $gid $group \
	&& useradd --uid $uid -g $group \
	-G www-data,root --shell /bin/bash \
	--create-home $user

# Set working directory
WORKDIR /var/www

USER $user
