FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
	libzip-dev \
    zip \
    unzip \
    vim \
    nano \
    cron \
    curl dirmngr apt-transport-https lsb-release ca-certificates \
    fontconfig \
    libfontenc1 libjpeg62-turbo libx11-6 libx11-data libxau6 libxcb1 \
    libxdmcp6 libxext6 libxfont-dev libxrender1 x11-common xfonts-75dpi \
    xfonts-base xfonts-encodings xfonts-utils \
    wget
RUN wget https://fonts.google.com/download?family=Noto%20Sans%20SC -O Noto_Sans_SC.zip \
    && unzip Noto_Sans_SC.zip -d /usr/share/fonts \
    && fc-cache 
RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.stretch_amd64.deb -O /usr/local/bin/wkhtmltopdf \
    && chmod +x /usr/local/bin/wkhtmltopdf \
    && dpkg -i --force-depends /usr/local/bin/wkhtmltopdf
    
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml zip

# Install xdebug
# RUN pecl install xdebug
# ADD /xdebug/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html


# USER $user