# Sample Tomcat application

## Start the tomcat application
kubectl apply -f tomcat.yml

## Useful kubectl commands for tomcat app

    kubectl -n tomcat-ps get pods
    kubectl -n tomcat-ps get svc
    kubectl -n tomcat-ps port-forward svc/tomcatappsvc <port>:80
    kubectl -n tomcat-ps logs <podname>
    kubectl -n tomcat-ps exec tomcatapp -- ls webapps -la
    cat /proc/meminfo
    kubectl -n tomcat-ps delete pod <podname>

## OpenTelemetry Related commands

    kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.19.1/cert-manager.yaml
    kubectl apply -f https://github.com/open-telemetry/opentelemetry-operator/releases/latest/download/opentelemetry-operator.yaml
    kubectl wait --for=condition=available deployment/opentelemetry-operator-controller-manager -n opentelemetry-operator-system
