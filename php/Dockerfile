# Dockerfile
FROM phpswoole/swoole:latest

# Install build tools, protobuf, unzip, git, curl
RUN apt-get update && apt-get install -y \
   gcc \
   make \
   autoconf \
   libprotobuf-dev \
   protobuf-compiler \
   unzip \
   git \
   curl \
   && apt-get clean \
   && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions via PECL
RUN pecl install opentelemetry \
   && pecl install protobuf \
   && docker-php-ext-enable opentelemetry protobuf

# COPY ./www/ /var/www/

#RUN curl -sSfL https://github.com/open-telemetry/opentelemetry-php-instrumentation/releases/download/v1.0.5/opentelemetry-php-instrumentation-installer.sh | bash
#RUN ( curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - || echo 'return 1' ) | \
#      sh -s gd xdebug
      
ENV OTEL_PHP_AUTOLOAD_ENABLED=true \
    OTEL_TRACES_EXPORTER=otlp \
    OTEL_METRICS_EXPORTER=none \
    OTEL_LOGS_EXPORTER=none \
    OTEL_EXPORTER_OTLP_PROTOCOL=http/protobuf \
    OTEL_EXPORTER_OTLP_ENDPOINT=http://otel-collector:4318 \
    OTEL_SERVICE_NAME=my-php-app \
    OTEL_SERVICE_VERSION=1.0.0 \
    OTEL_RESOURCE_ATTRIBUTES=deployment.environment=production,host.name=php-container
