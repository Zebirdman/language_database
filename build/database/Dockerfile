# build from alpine and author info
FROM mysql:8.0
MAINTAINER Ben Futterleib <benjamin.futterleib@gmail.com>
# run as root user
USER root
WORKDIR /sql

ENV DEBIAN_FRONTEND noninteractive

# add sql files and scripts
ADD SQL_data /sql
ADD my.cnf /etc/my.cnf

# add db creation script to the initdb folder to create our tables
RUN chmod 755 /sql/init-db.sh &&\
  mv /sql/init-db.sh /docker-entrypoint-initdb.d/

EXPOSE 3306
