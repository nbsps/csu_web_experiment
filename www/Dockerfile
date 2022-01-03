FROM mattrayner/lamp:latest

RUN rm -rf /var/www/html/*

COPY . /var/www/html/
EXPOSE 80

RUN rm -rf /var/www/html/encrypt \
    rm -rf /var/www/html/preset \
    rm -rf /var/www/html/Dockerfile \
    rm -rf /var/www/html/docker-compose.yml
