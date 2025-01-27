# Dockerfile for Laravel backend

# Sử dụng image PHP với Apache
FROM php:8.4-apache

# Cài đặt các PHP extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    zip \
    unzip \
    git && \
    # mariadb-server-core mariadb-client && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql xml && \
    a2enmod rewrite

# cai dat mysql client
RUN apt-get install -y mariadb-server-core mariadb-client

# Cài đặt nano (hoặc vim nếu bạn muốn)
RUN apt-get install -y nano \
    vim

# Cài đặt bash và cấu hình shell mặc định
RUN apt-get install -y bash && \
    chsh -s /bin/bash www-data

# Cài đặt Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Enable mod_rewrite for Apache
RUN a2enmod rewrite
# Copy mã nguồn Laravel vào container

# Cài đặt các dependencies của Laravel
WORKDIR /var/www/html/laravel-react-app/backend

# Copy mã nguồn Laravel vào thư mục /var/www/html/laravel-react-app
COPY . .

# Cấp quyền cho storage và bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/laravel-react-app/backend/storage \
    && chmod -R 775 /var/www/html/laravel-react-app/backend/storage \
    && chown -R www-data:www-data /var/www/html/laravel-react-app/backend/bootstrap/cache \
    && chmod -R 775 /var/www/html/laravel-react-app/backend/bootstrap/cache \
    && chmod -R a+w storage



# Cài đặt các package Laravel
RUN composer install --optimize-autoloader --no-dev

# Cấu hình Apache - giống httpd-vhost trên window
# COPY ./conf/apache-laravel.conf /etc/apache2/sites-available/000-default.conf

# Copy start.sh vào thư mục /conf trong container và cấp quyền thực thi -  file hosts
# COPY ./conf/start.sh /conf/start.sh
# RUN chmod +x /conf/start.sh

# Expose cổng Apache
EXPOSE 80

# Lệnh khởi động Apache
# CMD ["/conf/start.sh"]

