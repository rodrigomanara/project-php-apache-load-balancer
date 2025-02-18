FROM ubuntu/apache2

RUN apt-get update -y
RUN apt-get install libapache2-mod-fcgid nano -y \
    && a2enmod proxy_fcgi \
    &&  a2enmod rewrite \
    && service apache2 restart \

RUN chown -R www-data:www-data ./var/www
RUN chmod -R 755 ./var/www
