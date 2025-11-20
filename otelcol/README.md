## OpenTelemetry related commands

    kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.19.1/cert-manager.yaml
    kubectl apply -f https://github.com/open-telemetry/opentelemetry-operator/releases/latest/download/opentelemetry-operator.yaml
    kubectl wait --for=condition=available deployment/opentelemetry-operator-controller-manager -n opentelemetry-operator-system

## Useful kubectl commands for Tomcat app

    export DT_ENDPOINT=https://{your-env-id}.live.dynatrace.com/api/v2/otlp 
    export DT_API_TOKEN=dt0c01.MY_SECRET_TOKEN
    export OTEL_EXPORTER_OTLP_METRICS_TEMPORALITY_PREFERENCE=delta

## Useful docker commands for OpenTelemetry collector

    docker-compose -f docker-compose.yml up -d
    docker-compose -f docker-compose.yml stop
    docker-compose -f docker-compose.yml down
    docker ps
