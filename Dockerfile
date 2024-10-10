# Dockerfile для PHP-приложения

# Используем официальный образ PHP 7.4 с FPM
FROM php:7.4-fpm

# Установите необходимые пакеты
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Установите Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируйте файл composer.json
COPY composer.json /var/www/html/

# Если существует файл composer.lock, скопируйте его
RUN if [ -f composer.lock ]; then \
    COPY composer.lock /var/www/html/; \
fi

# Установите зависимости
RUN composer install

# Копируйте код приложения
COPY . /var/www/html/

# Настройте рабочую директорию
WORKDIR /var/www/html


# Откройте порт
EXPOSE 9000

# Запустите PHP-FPM
CMD ["php-fpm"]