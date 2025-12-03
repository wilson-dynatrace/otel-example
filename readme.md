# Opentelemetry Example from 0 to Dynatrace

## Preparation

1. In Dynatrace, create an access token with the Ingest scopes.
2. Setup the environment

export DT_ENDPOINT=https://{your-environment-id}.live.dynatrace.com/api/v2/otlp
export DT_API_TOKEN={your-api-token}

## Hands On

Start a new codespace.

## Exercise 1 Validate the target application

1. Go to tomcat folder
2. Start the tomcat application
      docker compose up -d
3. Once the tomcat container is up and running, you can
   a. Forward port 8090 to visit tomcat
   b. Run the curl container with "docker-compose -f docker-compose-test.yml up" to see if you get the web page (HTML)
