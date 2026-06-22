FROM php:8.2-cli

WORKDIR /app

RUN docker-php-ext-install pdo pdo_sqlite

COPY . .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
