# build from alpine and author info
FROM zeft/apache-php
MAINTAINER Ben Futterleib <benjamin.futterleib@gmail.com>
# run as root user
USER root

# set workdir for log file
WORKDIR /web

# setup folders and assign permissions
RUN rm -f /etc/php/7.0/php.ini && \
  mkdir /plog &&\
  touch /plog/errors.log &&\
  chown www-data:www-data /plog/errors.log &&\
  chmod -R 777 /plog/errors.log &&\
  rm -f /var/www/html/index.html

# add custom php.ini config
COPY build/web/php.ini /etc/php/7.0/php.ini
ADD web-app /var/www/html/

# move config file out of the root directory
RUN mv /var/www/html/config.php /var/www/config.php

# expose port 80 for apache
EXPOSE 80

# cmd and entrypoint
CMD ["-D","FOREGROUND"]
ENTRYPOINT ["/usr/sbin/apache2ctl"]
