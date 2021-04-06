# Cost Forecaster

Forecast the cost of infrastructure based on customer usage and expected growth.

![Cost Forecaster thumbnail](https://github.com/morcen/cost-forecaster/blob/master/public/assets/images/thumbnail.png)

## Tech stack
- Docker
- PHP 8
- nGinx
- HTML
- JavaScript
- CSS

## Setup
Using terminal, run the following commands under this project's directory:
- Build docker containers:
```bash
$ docker-compose up -d
```

- Generate autoload files
```bash
$ docker exec -it cost-forecaster-php-fpm  composer dumpautoload
```

- Confirm setup by checking in the browser at http://localhost:8080/

## Logical assumptions
- Forecast always starts at the next month
- Increase in growth is linear (always based on the initial studies)
- Storage is assumed and called SSD
- RAM is increased by blocks of 500MB, while SSD by 1GB (as in the real world). So if required to have 501MB of RAM, total RAM to be used for cost computation will be 1000MB (1GB)
