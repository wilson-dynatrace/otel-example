FROM phpswoole/swoole:6-php8.4-alpine  # Latest Swoole 6.x on PHP 8.4 (alpine is lightweight)

# RUN apt-get update && apt-get install -y \
#   gcc
# RUN composer install

WORKDIR /var/www

COPY . /var/www

RUN composer install --no-dev --optimize-autoloader

CMD ["php", "server.php"]
      
ENV OTEL_PHP_AUTOLOAD_ENABLED=true \
    OTEL_TRACES_EXPORTER=otlp \
    OTEL_METRICS_EXPORTER=none \
    OTEL_LOGS_EXPORTER=none \
    OTEL_EXPORTER_OTLP_PROTOCOL=http/protobuf \
    OTEL_EXPORTER_OTLP_ENDPOINT=http://otel-collector:4318 \
    OTEL_SERVICE_NAME=my-php-app \
    OTEL_SERVICE_VERSION=1.0.0 \
    OTEL_RESOURCE_ATTRIBUTES=deployment.environment=production,host.name=php-container
