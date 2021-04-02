FROM php:7.3-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/atrinium/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && \
    apt-get -y install \
        gnupg2 && \
    apt-get update && \
    apt-get -y install \
	    python\
            git \
            curl \
            openssh-client \
            nano \
            unzip \
            libcurl4-openssl-dev \
            libssl-dev \
        --no-install-recommends && \
        apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
        
# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin

RUN docker-php-ext-install \
        pdo_mysql

# Node.js
#RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - && \
 #   curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
  #  echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
   # apt-get update && \
   # apt-get install -qq -y build-essential nodejs yarn

        
RUN a2enmod rewrite

EXPOSE 443
EXPOSE 80
EXPOSE 5432
RUN a2enmod lbmethod_byrequests

CMD ["apache2ctl", "-D", "FOREGROUND"]
