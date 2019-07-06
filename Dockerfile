FROM alpine:latest

RUN apk add --no-cache nginx curl supervisor php7 php7-fpm php7-pdo php7-pdo_sqlite php7-curl

COPY --chown=http:http . /public_html

