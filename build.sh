#!/bin/bash
docker stop langdb-web
docker stop langdb-db
docker rm langdb-web
docker rm langdb-db
docker rmi zeft/langdb-db
docker rmi zeft/langdb-web
docker build -t zeft/langdb-web -f build/web/Dockerfile .
docker build -t zeft/langdb-db -f build/database/Dockerfile build/database

docker run -dit --name wsr-db -p 3306:3306 \
  --env="MYSQL_ROOT_PASSWORD=hudeg9m5" \
  --env="MYSQL_DATABASE=database" \
  --env="MYSQL_USER=language_user" \
  --env="MYSQL_PASSWORD=.Hudeg9m5" \
  --env="MYSQL_ROOT_HOST=%" \
  --network=host \
  --name=langdb-web \
  zeft/langdb-db

docker run -dit --name wsr-app -p 81:80 \
  --env="DB_CONN_IP=127.0.0.1" \
  --env="DB_CONN_PORT=3306" \
  -v plog-output:/plog \
  -v php-logs:/var/log/apache2 \
  --network=host \
  --name=langdb-db \
  zeft/langdb-web
