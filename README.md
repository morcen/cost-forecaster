# LMS Forecaster

Forecast the cost of LMS infrastructure based on customer usage and expected growth.

# Setup
Using terminal, run the following commands under this project's directory:
- Build docker containers:
```bash
$ docker-compose up -d
```

- Generate autoload files
```bash
$ docker exec -it lsm-forecaster-php-fpm  composer dumpautoload
```

- Confirm setup by checking in the browser at http://localhost:8080/
