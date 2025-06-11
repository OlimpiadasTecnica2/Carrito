FROM trafex/php-nginx:latest
USER root
RUN apk add --no-cache ssmtp php84-pdo_sqlite sqlite-dev php84-sqlite3
COPY . /var/www/html

COPY ssmtp.conf /etc/ssmtp/ssmtp.conf
COPY php-conf.ini /etc/php84/php.ini
RUN ls /usr/lib/php84/modules/
RUN chmod 777 api 
RUN touch api/base.db
RUN chmod 777 api/base.db 
USER nobody