FROM phpdockerio/php80-fpm
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get -y update && apt-get install -y libicu-dev php8.0-intl
