# Dockerfile
#FROM phpswoole/swoole:latest
#FROM php:8.3-fpm   # or php:8.3-cli, php:8.3-apache, etc.
FROM shivammathur/opentelemetry-php:8.3-fpm-latest

COPY . /var/www/html
WORKDIR /var/www/html

# COPY ./www/ /var/www/

RUN curl -sSfL https://github.com/open-telemetry/opentelemetry-php-instrumentation/releases/download/v1.0.5/opentelemetry-php-instrumentation-installer.sh | bash

ENV OTEL_PHP_AUTOLOAD_ENABLED=true \
    OTEL_TRACES_EXPORTER=otlp \
    OTEL_METRICS_EXPORTER=none \
    OTEL_LOGS_EXPORTER=none \
    OTEL_EXPORTER_OTLP_PROTOCOL=http/protobuf \
    OTEL_EXPORTER_OTLP_ENDPOINT=http://otel-collector:4318 \
    OTEL_SERVICE_NAME=my-php-app \
    OTEL_SERVICE_VERSION=1.0.0 \
    OTEL_RESOURCE_ATTRIBUTES=deployment.environment=production,host.name=php-container
