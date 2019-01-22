# Base Docker Web
This base repo allows you to make jump with the docker. You may easily clone and run empty site & site with yii2 pre-installed.

## Default images
* nginx:1.15.2-alpine
* php:7.3-fpm (customed with dev libs such as zip, ssh, msmtp & composer)
* mysql:8 (with database init scripts)
* schickling/mailcatcher

## Install
1. Clone repo
2. Options:  
2.1. To run empty web site do `./init.sh site`   
2.2. To run yii2 based web site do `./init.sh site-yii`   
2.3. To down containers and clean tmp folders run `./init.sh reset`

## Enjoy
Don't forget to add aliases to /etc/hosts  
`127.0.0.1 mysite.docker.local mysite-yii.docker.local mailtrap.docker.local`
