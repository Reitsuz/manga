FROM php:8.4-cli

WORKDIR /app

COPY . .

# .env 強制作成
RUN echo "APP_NAME=Manga" > .env
RUN echo "APP_ENV=production" >> .env
RUN echo "APP_DEBUG=false" >> .env
RUN echo "APP_URL=https://manga-0cm6.onrender.com" >> .env
RUN echo "APP_KEY=base64:Z/FBG5d//85ECPVg7UyWhtbKUiI9rLLJvb1XQmMqRRU=" >> .env
RUN echo "SESSION_DRIVER=file" >> .env
RUN echo "CACHE_STORE=file" >> .env
RUN echo "QUEUE_CONNECTION=sync" >> .env

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public