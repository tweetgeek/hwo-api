FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_KEY base64:zIz8X5Qp7n9/uMFHLKkUVFsDMiJ2ne537cGbQK66GdQ=
ENV APP_ENV staging
ENV APP_DEBUG true
ENV LOG_CHANNEL stderr
ENV DATABASE_URL dpg-chjts29mbg5f0s6jv54g-a
ENV DB_CONNECTION pgsql

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
