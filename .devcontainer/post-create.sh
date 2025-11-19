#!/bin/bash

echo "[post-create] start" >> ~/status

# Setup Kind
kind create cluster --config .devcontainer/kind-cluster.yml --wait 300s

echo "[post-create] complete" >> ~/status
