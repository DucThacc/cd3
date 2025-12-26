FROM php:8.1-apache

# Cài đặt extension mysqli để kết nối MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Cấp quyền cho thư mục uploads
RUN mkdir -p /var/www/html/uploads && chmod 777 /var/www/html/uploads

# Copy code vào container
COPY src/ /var/www/html/

# Change Apache listen port to 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
	&& sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

EXPOSE 8080
