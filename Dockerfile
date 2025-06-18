FROM php:8.2-cli

# Install extensions that are necessary, f.e mysqli o pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Copy code
WORKDIR /app
COPY . /app

# Install dependencies 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Port 3000
EXPOSE 3000

# Command
CMD ["php", "-S", "0.0.0.0:3000", "-t", "src"]