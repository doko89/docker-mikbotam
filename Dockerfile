FROM alpine:3.9

RUN apk add --no-cache nginx curl supervisor php7 php7-fpm php7-pdo php7-pdo_sqlite php7-curl && \
    mkdir -p /run/nginx && sed -i 's+nobody+nginx+g;s+127.0.0.1:9000+/run/php7.2-fpm.sock+' /etc/php7/php-fpm.d/www.conf

COPY --chown=nginx:nginx . /public_html

COPY /conf/nginx/mikbotam.conf /etc/nginx/conf.d/default.conf

COPY /conf/supervisor /etc/supervisor.d

COPY /conf/run.sh /run.sh

WORKDIR /public_html

EXPOSE 80

CMD ["/run.sh"]
