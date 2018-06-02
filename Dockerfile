FROM nimmis/apache-php7

WORKDIR /var/www/html

ADD ./cadADEB.conf /etc/apache2/sites-available/000-default.conf

ADD ./ .
