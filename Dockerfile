FROM trafex/php-nginx:latest
USER root
RUN apk add --no-cache msmtp php84-pdo_sqlite sqlite-dev php84-sqlite3
COPY . /var/www/html

COPY ssmtp.conf /etc/msmtprc
RUN ln -sf /usr/bin/msmtp /usr/sbin/sendmail
#COPY php-conf.ini /etc/php84/php.ini
RUN ls /usr/lib/php84/modules/
#RUN mkdir /var/www/html/api
RUN chmod -R 777 /var/www/html/api
RUN chmod -R 777 api
RUN touch /var/www/html/api/base.db
RUN touch api/base.db
RUN chmod 777 /var/www/html/api/base.db
RUN chmod 777 api/base.db
RUN ls -la /var/www/html/ 
USER nobody