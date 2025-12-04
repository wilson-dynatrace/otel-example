Commands:

<code>docker-compose -f "docker-compose.yml" up --build --force-recreate -d</code><br>
<code>docker-compose -f "docker-compose.yml" stop</code><br>

Once the container is running, forward port 8000 to access the application.

Commands to verify versions:

<code>docker run --rm phpswoole/swoole:latest "php -m"</code><br>
<code>docker run --rm phpswoole/swoole:latest "php --ri swoole"</code><br>
<code>docker run --rm phpswoole/swoole:latest "composer --version"</code><br>
