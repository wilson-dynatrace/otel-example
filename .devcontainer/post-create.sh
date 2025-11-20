#!/bin/bash

echo "[post-create] start" >> ~/status

# Setup Kind
# Note it is using port 4318, will have conflict with otel-collector
# kind create cluster --config .devcontainer/kind-cluster.yml --wait 300s

echo "[post-create] complete" >> ~/status
