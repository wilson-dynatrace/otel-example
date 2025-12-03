# Opentelemetry Example from 0 to Dynatrace

## Preparation

1. In Dynatrace, create an access token with the Ingest scopes.
2. Setup the environment

   <code>
   export DT_ENDPOINT=https://{your-environment-id}.live.dynatrace.com/api/v2/otlp
   export DT_API_TOKEN={your-api-token}
   </code>

## Hands On

Start a new codespace.

### Exercise 1 Validate the target application

1. Go to tomcat folder
2. Start the tomcat application
   <code>docker compose up -d</code>
3. Once the tomcat container is up and running, you can<br>
   a. Forward port 8090 to visit tomcat<br>
   b. Run the curl container with <code>docker-compose -f docker-compose-test.yml up</code> to see if you get the web page (HTML)<br>
4. Stop the tomcat container using <code>docker compose down</code>

Note that the tomcat does not have any instrumentation.

<table>
   <tr>
      <th>Docker</th>
      <th>Kubernetes</th>
   </tr>
   <tr>
      <td>
         Files involved:
         <ul>
           <li>.env</li>
           <li>tomcat/docker-compose.yml</li>
           <li>tomcat/docker-compose-test.yml</li>
         </ul>
      </td>
      <td>
      </td>
   </tr>
</table>

### Exercise 2 Monitor the application with OpenTelemetry

#### Start the OpenTelemetry suite

1. Go to otelcol folder
2. Launch the OpenTelemetry suite <code>docker compose up -d</code>
3. Once the services are ready, Forward port 16686 to access the Jaeger UI

#### Update tomcat to include the Opentelemetry instrumentation 

1. In tomcat folder, modify the docker-compose.yml and remove the comments from line 14-23
2. Launch the tomcat container again <code>docker compose up -d</code>
3. Visit the (tomcat) web application to trigger a transaction

You should see the distributed trace in Jaeger UI.

<table>
   <tr>
      <th>Docker</th>
      <th>Kubernetes</th>
   </tr>
   <tr>
      <td>
         Files involved.
         <ul>
           <li>.env</li>
           <li>otelcol/docker-compose.yml</li>
           <li>otelcol/src/otel-collector-config.yml</li>
         </ul>
      </td>
      <td>
      </td>
   </tr>
</table>

### Exercise 3 Forward the telemetry data to Dynatrace

1. Stop the Opentelemetry suite (if running)
2. Setup the environment. Make sure the following environment variables are define<br>
   DT_ENDPOINT<br>
   DT_API_TOKEN<br>
3. In otelcol/src folder, modify the docker-compose-config.yml and remove the comments from line 17-23 and 33-44
4. Launch the OpenTelemetry suite <code>docker compose up -d</code>
5. Visit the web application to trigger a transaction

You should see the distributed trace in Jaeger UI as well as Dynatrace UI.

<table>
   <tr>
      <th>Docker</th>
      <th>Kubernetes</th>
   </tr>
   <tr>
      <td>
         Files involved.
         <ul>
           <li>.env</li>
           <li>otelcol/docker-compose.yml</li>
           <li>otelcol/src/otel-collector-config.yml</li>
         </ul>
      </td>
      <td>
      </td>
   </tr>
</table>

### Exercise 4 Collect telemetry data with OpenTelemetry Collector

1. Stop the Opentelemetry suite (if running)
2. Launch the collector only container via <code>docker-compose -f docker-compose-min.yml up</code>
3. Visit the web page to trigger a transaction and validate the result in Dynatrace (note Jaeger not longer running); You may restart the tomcat container to resume the connection.

<table>
   <tr>
      <th>Docker</th>
      <th>Kubernetes</th>
   </tr>
   <tr>
      <td>
         Files involved.
         <ul>
           <li>.env</li>
           <li>otelcol/docker-compose-min.yml</li>
           <li>otelcol/src/otel-collector-config-dt.yml</li>
         </ul>
      </td>
      <td>
      </td>
   </tr>
</table>

### Exercise 5 Collect telemetry data with Dynatrace OpenTelemetry Collector

1. Stop the Opentelemetry suite or collector (if running)
2. Go to <code>dtotelcol</code> folder and launch the Dynatrace collector via <code>docker compose up -d</code>
3. Visit the web page to trigger a transaction and validate the result in Dynatrace; Again, you may restart the tomcat container to resume the connection.

<table>
   <tr>
      <th>Docker</th>
      <th>Kubernetes</th>
   </tr>
   <tr>
      <td>
         Files involved.
         <ul>
           <li>.env</li>
           <li>dtotelcol/docker-compose.yml</li>
           <li>dtotelcol/otel-collector-config.yml</li>
         </ul>
      </td>
      <td>
      </td>
   </tr>
</table>
