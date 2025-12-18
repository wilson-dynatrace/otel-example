Setup:

Make sure a local network named OpenTelemetry is available, e.g. by start the Dynatrace Opentelemetry collector.


Commands:

<code>docker-compose -f "docker-compose.yml" up --build --force-recreate -d</code><br>
<code>docker-compose -f "docker-compose.yml" stop</code><br>

Build and run the image

docker build -t <image-name> . && docker run -d -p <host-port>:<container-port> <image-name>

Once the container is running, forward port 8000 to access the application.

Commands to verify versions:

<code>docker run --rm phpswoole/swoole:latest "php -m"</code><br>
<code>docker run --rm phpswoole/swoole:latest "php --ri swoole"</code><br>
<code>docker run --rm phpswoole/swoole:latest "php --ri opentelemetry"</code><br>
<code>docker run --rm phpswoole/swoole:latest "composer --version"</code><br>

Note for PHP/Swoole and OpenTelemetry
- Auto-instrumentation is available and easy for traditional PHP apps.
- With Swoole: it is not reliably supported — use manual instrumentation instead for accurate, complete tracing.
