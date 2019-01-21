#!/usr/bin/env bash

./clear.sh

sudo rm -rf runtime
mkdir -p runtime
chmod -R 777 runtime

docker-compose build
docker-compose up -d