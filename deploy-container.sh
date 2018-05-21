#!/bin/bash
docker run -dit --name wsr-db -p 3307:3306 \
  --env="MYSQL_ROOT_PASSWORD=hudeg9m5" \
  --env="MYSQL_DATABASE=database" \
  --env="MYSQL_USER=language_user" \
  --env="MYSQL_PASSWORD=.Hudeg9m5" \
  --env="MYSQL_ROOT_HOST=%" \
  custom/db

docker run -dit --name wsr-app -p 81:80 \
  -v plog-output:/plog \
  -v php-logs:/var/log/apache2 \
  custom/web
