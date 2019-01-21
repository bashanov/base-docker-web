#!/usr/bin/env bash

FOLDER=mysite-yii

./clear.sh

sudo rm -rf runtime $FOLDER/runtime $FOLDER/vendor $FOLDER/composer.lock
mkdir -p runtime $FOLDER/runtime $FOLDER/runtime/properties $FOLDER/public/assets $FOLDER/models
chmod -R 777 runtime $FOLDER/runtime $FOLDER/public/assets $FOLDER/models
echo mysql >> $FOLDER/runtime/properties/mysql_host

docker-compose build
docker-compose run --rm php composer install -d /var/www/$FOLDER/
docker-compose up -d