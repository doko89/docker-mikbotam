FROM alpine:latest

RUN apk add --no-cache nginx curl supervisor php7 php7-fpm php7-pdo php7-pdo_sqlite php7-curl

COPY --chown=http:http . /public_html

COPY /conf/nginx /etc/conf.d

COPY /conf/supervisor /etc/supervisor.d

COPY /conf/run.sh /run.sh

WORKDIR /public_html

EXPOSE 80

CMD ["/run.sh"]
