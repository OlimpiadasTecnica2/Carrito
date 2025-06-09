FROM trafex/php-nginx:latest
USER root
RUN apk add --no-cache ssmtp php84-sqlite3 sqlite

COPY ssmtp.conf /etc/ssmtp/ssmtp.conf
USER nobody