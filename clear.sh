#!/usr/bin/env bash

FOLDER=mysite-yii

sudo rm -rf runtime $FOLDER/runtime $FOLDER/vendor $FOLDER/composer.lock
docker-compose down