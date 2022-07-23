# Microservice example 

## Requirements

1. Docker

## Installation

- run `make all`

Above command will:

1. Create and build the docker containers.
2. Install composer dependencies.
3. Do linting checks.

## Commands

- Create database `docker exec project_api php bin/console doctrine:database:create`
- Create Schema `docker exec project_api php bin/console doctrine:schema:create`
- Drop database `docker exec project_api php bin/console doctrine:database:drop --force`

## phpmyadmin login

- Server `project_mysql:3306` | Username `root`

## Running

- You can access the mocked api endpoints via `http://localhost:90/api`
- You can access the frontend to display the server health check via `http://localhost:3000/`


## Errors 

- https://stackoverflow.com/questions/20127884/runtimeexception-unable-to-create-the-cache-directory-var-www-sonata-app-cach
- Using curl Error: Failed to connect to localhost port 90: Connection refused : https://laracasts.com/index.php/index.php/discuss/channels/laravel/guzzlehttp-exception-connectexception-curl-error-7-failed-to-connect-to-localhost-port-8087-connection-refused