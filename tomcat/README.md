# Sample Tomcat application

## Start the tomcat application via docker

    docker-compose -f docker-compose.yml up

## Start the tomcat application via kubectl

    kubectl apply -f tomcat.yml

## Useful kubectl commands for tomcat app

    kubectl -n tomcat-ps get pods
    kubectl -n tomcat-ps get svc
    kubectl -n tomcat-ps port-forward svc/tomcatappsvc <port>:80
    kubectl -n tomcat-ps logs <podname>
    kubectl -n tomcat-ps exec tomcatapp -- ls webapps -la
    cat /proc/meminfo
    kubectl -n tomcat-ps delete pod <podname>
