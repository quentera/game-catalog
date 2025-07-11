# dockerfiles/nginx.dockerfile

FROM nginx:alpine

COPY dockerfiles/configs/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www/html
