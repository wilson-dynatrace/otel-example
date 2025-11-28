#!/bin/bash

# export DT_ENDPOINT=https://{your-env-id}.live.dynatrace.com/api/v2/otlp
export DT_ENDPOINT=https://eou37502.apps.dynatrace.com/api/v2/otlp
export DT_API_TOKEN=dt0c01.MY_SECRET_TOKEN 
export OTEL_EXPORTER_OTLP_METRICS_TEMPORALITY_PREFERENCE=delta#!/bin/bash
echo $DT_ENDPOINT
echo $DT_API_TOKEN
echo $OTEL_EXPORTER_OTLP_METRICS_TEMPORALITY_PREFERENCE
