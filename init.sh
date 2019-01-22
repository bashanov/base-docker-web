#!/usr/bin/env bash

WEB_SITE=mysite
WEB_SITE_YII=mysite-yii

down_docker_compose(){
    if [[ $(docker-compose top) ]]; then
        docker-compose down
    fi
}

run_docker_compose(){
    if [[ -z $(docker-compose top) ]]; then
        docker-compose up -d
    fi
}

clear_docker_tmp_folders(){
    sudo rm -rf runtime $WEB_SITE_YII/runtime $WEB_SITE_YII/vendor $WEB_SITE_YII/composer.lock
}

create_tmp_folders(){
    mkdir -p runtime $WEB_SITE_YII/runtime $WEB_SITE_YII/runtime/properties $WEB_SITE_YII/public/assets $WEB_SITE_YII/models
    sudo chmod -R 777 runtime $WEB_SITE_YII/runtime $WEB_SITE_YII/public/assets
}

if [ $# -eq 0 ]
  then
    echo "No arguments supplied. Run with --help to get more information."
    exit
fi

while test $# -gt 0
do
    case "$1" in
        --help)
            echo "[arguments]"
            echo "reset     - down composer, clear tmp folders"
            echo "site      - run empty web site"
            echo "site-yii  - run yii2 website (or just install composer dependencies if docker is already running)"
            ;;
        reset)
            down_docker_compose
            docker-compose build
            clear_docker_tmp_folders
            ;;
        site)
            create_tmp_folders
            run_docker_compose
            ;;
        site-yii)
            create_tmp_folders
            echo mysql >> $WEB_SITE_YII/runtime/properties/mysql_host
            docker-compose run --rm php composer install -d /var/www/$WEB_SITE_YII/
            run_docker_compose
            ;;
        --*) echo "Unknown option $1"
            ;;
        *) echo "Unknown argument $1"
            ;;
    esac
    shift
done

exit 0