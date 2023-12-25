FROM quay.io/centos/centos:stream9

RUN yum -y update && yum clean all

# Install Apache
RUN yum -y install httpd && systemctl enable httpd

# Install SSL
RUN yum -y install mod_ssl openssl
WORKDIR /etc/pki/tls/certs
RUN openssl genrsa > /etc/pki/tls/certs/server.key && \
    openssl req -new -key /etc/pki/tls/certs/server.key > /etc/pki/tls/certs/server.csr -subj "/C=JP/ST=OSAKA/L=OSAKA/O=SAMPLE CORP/OU=ALL/CN=sample.local" && \
    openssl x509 -req -signkey /etc/pki/tls/certs/server.key < /etc/pki/tls/certs/server.csr > /etc/pki/tls/certs/server.crt && \
    cp -a /etc/pki/tls/certs/server.key /etc/pki/tls/private/
WORKDIR /var/www/html/app

# Install PHP
RUN dnf -y install https://rpms.remirepo.net/enterprise/remi-release-9.rpm && \
    dnf config-manager --set-enabled remi && \
    dnf -y module enable php:remi-8.2 && \
    dnf -y update && \
    dnf -y install php
## PHP Library
RUN dnf -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-9.noarch.rpm && \
    dnf -y install php-pdo php-pear php-devel php-gd php-mysqlnd php-zip

## Install composer 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Install SQL Server ODBC
## ODBC DRIVER
RUN curl https://packages.microsoft.com/config/rhel/9.0/prod.repo > /etc/yum.repos.d/mssql-release.repo && \
    ACCEPT_EULA=Y dnf -y install msodbcsql18 mssql-tools18 unixODBC-devel
## Microsoft ODBC for SQL Server
COPY ./docker/config/centos/centos.repo /etc/yum.repos.d/centos.repo
RUN dnf -y install libtool-ltdl-devel && \
    pecl install sqlsrv pdo_sqlsrv && \
    echo extension=pdo_sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini && \
    echo extension=sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/20-sqlsrv.ini
# Reference
# https://gijutsu.com/2023/03/18/linux-php-windows-sqlserver/
# https://learn.microsoft.com/ja-jp/sql/connect/php/installation-tutorial-linux-mac?view=sql-server-ver16#installing-on-red-hat

CMD ["/sbin/init"]